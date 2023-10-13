<?php

namespace App\Models;

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

class Room extends Model
{
    // use HasMediaTrait {
    //     getFirstMediaUrl as protected getFirstMediaUrlTrait;
    // }
//    use HasTranslations, Rating;
   public static $rules = [
       'room_number' => 'required|max:127',
       'hotel_id' => 'required|exists:hotels,id',
       'amount' => 'required',
   ];
    public $table = 'rooms';
    public $fillable = [
        'room_number',
        'hotel_id',
        'amount',
        'available',
        'floor',
        'description'
    ];
    protected $casts = [
        'room_number' => 'string',
        'hotel_id' => 'integer',
        'amount' => 'double',
        'available' => 'boolean',
        'floor' => 'string',
        'description' => 'string',
    ];
    protected $appends = [
        'custom_fields',
    ];

    public function hotels(): BelongsTo
    {
        return $this->belongsTo(Hotel::class);
    }
    public function getCustomFieldsAttribute()
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
    public function customFieldsValues()
    {
        return $this->morphMany('App\Models\CustomFieldValue', 'customizable');
    }
}
