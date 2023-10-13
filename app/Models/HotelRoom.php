<?php

namespace App\Models;

use App\Traits\HasTranslations;
use Illuminate\Database\Eloquent\Model;

class HotelRoom extends Model
{
    use HasTranslations;

    /**
     * Validation rules
     *
     * @var array
     */
    public static $rules = [
        'hotel_id' => 'required|exists:hotels,id',
        'room_no' => 'required|max:127',
        'price' => 'required|numeric|min:0|max:99999999,99'
    ];
    public $translatable = [
        'name',
    ];
    public $table = 'hotel_rooms';
    public $fillable = [
        'hotel_id',
        'room_no',
        'price',
        'description',
        'available',
        'files',
        'note',
        'accepted',
        'available',
        'featured',
    ];
    /**
     * The attributes that should be casted to native types.
     *
     * @var array
     */
    protected $casts = [
        'room_no' => 'string',
        'price' => 'double',
        'hotel_id' => 'integer',
        'note' => 'string'
    ];
    /**
     * New Attributes
     *
     * @var array
     */
    protected $appends = [
        'custom_fields',

    ];
    protected $hidden = [
        "created_at",
        "updated_at",
    ];

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

    public function hotel()
    {
        return $this->belongsTo(Hotel::class);
    }
}
