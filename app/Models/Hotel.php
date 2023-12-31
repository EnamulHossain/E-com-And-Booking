<?php

namespace App\Models;

use App\Casts\HotelCast;
use App\HotelGallery;
use Carbon\Carbon;
use Carbon\CarbonPeriod;
use App\Traits\HasTranslations;
use Illuminate\Contracts\Database\Eloquent\Castable;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\Relations\HasManyThrough;
use Illuminate\Database\Eloquent\Relations\MorphMany;
use Illuminate\Support\Facades\DB;
use Spatie\Image\Exceptions\InvalidManipulation;
use Spatie\Image\Manipulations;
use Spatie\MediaLibrary\HasMedia\HasMedia;
use Spatie\MediaLibrary\HasMedia\HasMediaTrait;
use Spatie\MediaLibrary\Models\Media;
use Spatie\OpeningHours\OpeningHours;
use App\Concerns\Rating;

class Hotel extends Model implements HasMedia, Castable
{
    use HasMediaTrait {
        getFirstMediaUrl as protected getFirstMediaUrlTrait;
    }
    use HasTranslations, Rating;

    /**
     * Validation rules
     *
     * @var array
     */
    public static $rules = [
        'name' => 'required|max:127',
        'hotel_level_id' => 'required|exists:hotel_levels,id',
        'address_id' => 'required|exists:addresses,id',
        'phone_number' => 'max:50',
        'mobile_number' => 'max:50',
        'availability_range' => 'required|max:9999999,99|min:0'
    ];
    public $translatable = [
        'name',
        'description',
    ];
    public $table = 'hotels';
    public $fillable = [
        'name',
        'hotel_level_id',
        'address_id',
        'description',
        'phone_number',
        'mobile_number',
        'availability_range',
        'available',
        'featured',
        'accepted'
    ];

    /**
     * The attributes that should be casted to native types.
     *
     * @var array
     */
    protected $casts = [
        'image' => 'string',
        'name' => 'string',
        'hotel_level_id' => 'integer',
        'address_id' => 'integer',
        'description' => 'string',
        'phone_number' => 'string',
        'mobile_number' => 'string',
        'availability_range' => 'double',
        'available' => 'boolean',
        'featured' => 'boolean',
        'accepted' => 'boolean'
    ];
    /**
     * New Attributes
     *
     * @var array
     */
    protected $appends = [
        'custom_fields',
        'has_media',
        'rate',
        'closed',
        'total_reviews'
    ];

    protected $hidden = [
        "created_at",
        "updated_at",
    ];

    /**
     * @return string
     */
    public static function castUsing(): string
    {
        return HotelCast::class;
    }

    public function discountables(): MorphMany
    {
        return $this->morphMany('App\Models\Discountable', 'discountable');
    }

    /**
     * @param Media|null $media
     * @throws InvalidManipulation
     */
    public function registerMediaConversions(Media $media = null)
    {
        $this->addMediaConversion('thumb')
            ->fit(Manipulations::FIT_CROP, 200, 200)
            ->sharpen(10);

        $this->addMediaConversion('icon')
            ->fit(Manipulations::FIT_CROP, 100, 100)
            ->sharpen(10);
    }

    /**
     * to generate media url in case of fallback will
     * return the file type icon
     * @param string $conversion
     * @return string url
     */
    public function getFirstMediaUrl($collectionName = 'default', $conversion = '')
    {
        $url = $this->getFirstMediaUrlTrait($collectionName);
        $array = explode('.', $url);
        $extension = strtolower(end($array));
        if (in_array($extension, config('medialibrary.extensions_has_thumb'))) {
            return asset($this->getFirstMediaUrlTrait($collectionName, $conversion));
        } else {
            return asset(config('medialibrary.icons_folder') . '/' . $extension . '.png');
        }
    }

    public function getCustomFieldsAttribute(): array
    {
        $hasCustomField = in_array(static::class, setting('custom_field_models', []));
        if (!$hasCustomField) {
            return [];
        }
        $array = $this->customFieldsValues()
            ->join('custom_fields', 'custom_fields.id', '=', 'custom_field_values.custom_field_id')
            ->where('custom_fields.in_table', '=', true)
            ->get()->toArray();

        return convertToAssoc($array, 'name');
    }

    public function customFieldsValues(): MorphMany
    {
        return $this->morphMany('App\Models\CustomFieldValue', 'customizable');
    }

    public function scopeNear($query, $latitude, $longitude, $areaLatitude, $areaLongitude)
    {
        // Calculate the distant in mile
        $distance = "SQRT(
                    POW(69.1 * (addresses.latitude - $latitude), 2) +
                    POW(69.1 * ($longitude - addresses.longitude) * COS(addresses.latitude / 57.3), 2))";

        // Calculate the distant in mile
        $area = "SQRT(
                    POW(69.1 * (addresses.latitude - $areaLatitude), 2) +
                    POW(69.1 * ($areaLongitude - addresses.longitude) * COS(addresses.latitude / 57.3), 2))";

        // convert the distance to KM if the distance unit is KM
        if (setting('distance_unit') == 'km') {
            $distance .= " * 1.60934"; // 1 Mile = 1.60934 KM
            $area .= " * 1.60934"; // 1 Mile = 1.60934 KM
        }

        return $query
            ->join('addresses', 'hotels.address_id', '=', 'addresses.id')
            ->whereRaw("$distance < hotels.availability_range")
            ->select(DB::raw($distance . " AS distance"), DB::raw($area . " AS area"), "hotels.*")
            ->orderBy('area');
    }

    /**
     * Provider ready when he is accepted by admin and marked as available
     * and is open now
     */
    public function getClosedAttribute(): bool
    {
        return !$this->accepted || !$this->attributes['available'] ;
//            || $this->openingHours()->isClosed();
    }

//    public function openingHours(): OpeningHours
//    {
//        $openingHoursArray = [];
//        foreach ($this->availabilityHours as $element) {
//            $openingHoursArray[$element['day']][] = $element['start_at'] . '-' . $element['end_at'];
//        }
//        return OpeningHours::createAndMergeOverlappingRanges($openingHoursArray);
//    }

    /**
     * get each range of 30 min with open/close hotel
     */
    public function weekCalendarRange(Carbon $date, int $employeeId): array
    {
        $period = CarbonPeriod::since($date->subDay()->ceilDay())->minutes(30)->until($date->addDay()->ceilDay()->subMinutes(30));
        $dates = [];
        // Iterate over the period
        foreach ($period as $key => $d) {
            $firstDate = $d->locale('en')->toDateTime();
            $isOpen = $firstDate > new \DateTime("now");
//            if($isOpen){
//                $isOpen = $this->openingHours()->isOpenAt($firstDate);
//                if ($isOpen && $employeeId != 0) {
//                    $isOpen = !($this->bookings()->where('booking_at', '=', $firstDate)
//                        ->where('cancel', '<>', '1')
//                        ->whereNotIn('booking_status_id', ['6', '7'])
//                        ->where('employee_id', '=', $employeeId)
//                        ->count());
//                }
//            }
            $times = $d->locale('en')->toIso8601String();
            $dates[] = [$times, $isOpen];
        }
        return $dates;
    }

    /**
     * @return HasMany
     **/
    public function bookings(): HasMany
    {
        return $this->hasMany(HotelBooking::class, 'hotel->id')->orderBy('booking_at');
    }

    public function getRateAttribute(): float
    {
        return (float)$this->hotelReviews()->avg('rate');
    }

    /**
     * @return HasManyThrough
     **/
    public function hotelReviews(): HasManyThrough
    {
        return $this->hasManyThrough(HotelReview::class, HotelBooking::class, "hotel->id", 'booking_id', 'id', 'id');
    }

    public function getTotalReviewsAttribute(): float
    {
        return $this->hotelReviews()->count();
    }

    /**
     * @return BelongsTo
     **/
    public function hotelLevel(): BelongsTo
    {
        return $this->belongsTo(HotelLevel::class, 'hotel_level_id', 'id');
    }

    /**
     * @return HasMany
     **/
    public function awards(): HasMany
    {
        return $this->hasMany(Award::class, 'hotel_id');
    }

    /**
     * @return HasMany
     **/
    public function experiences(): HasMany
    {
        return $this->hasMany(Experience::class, 'hotel_id');
    }

    /**
     * @return HasMany
     **/
//    public function availabilityHours(): HasMany
//    {
//        return $this->hasMany(AvailabilityHour::class, 'hotel_id')->orderBy('start_at');
//    }

    /**
     * @return HasMany
     **/
    public function eServices(): HasMany
    {
        return $this->hasMany(EService::class, 'hotel_id');
    }

    /**
     * @return HasMany
     **/
    public function galleries(): HasMany
    {
        return $this->hasMany(HotelGallery::class, 'hotel_id');
    }

    /**
     * @return BelongsToMany
     **/
    public function users(): BelongsToMany
    {
        return $this->belongsToMany(User::class, 'hotel_users');
    }

    /**
     * @return BelongsTo
     **/
    public function address(): BelongsTo
    {
//        return $this->belongsTo(Address::class, 'address_id');
        return $this->belongsTo(HotelAddress::class, 'hotel_address_id');
    }

    /**
     * @return BelongsToMany
     **/
    public function taxes(): BelongsToMany
    {
        return $this->belongsToMany(Tax::class, 'hotel_taxes');
    }

    public function rooms(): BelongsToMany
    {
        return $this->belongsToMany(Room::class, 'rooms');
    }

    /**
     * Add Media to api results
     * @return bool
     */
    public function getHasMediaAttribute(): bool
    {
        return $this->hasMedia('image');
    }

    public function getMediaListBox()
    {
        $medias = $this->media ?? [];

        $html = "";
        foreach($medias as $key => $media) {
            $class = "";

            if($key == 0) {
                $class = "active";
            }

            $html .= "<div class='item {$class}'><img src='{$media->url}' alt='{$media->name}'></div>";
        }

        return $html;
    }

    public function getMediaindicators( string $tergetId)
    {
        $medias = $this->media->count() ?? [];

        $html = "";
        for ($i=0; $i < $medias; $i++) {
            $class = "";

            if($i == 0) {
                $class = "class='active'";
            }

            $html .= "<li data-target='#{$tergetId}' data-slide-to='{$i}' {$class}></li>";
        }

        return $html;
    }


}