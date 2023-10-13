<?php
/*
 * File name: AvailabilityHour.php
 * Last modified: 2022.02.02 at 21:21:31
 * Author: Nefold - https://nefold.com
 * Copyright (c) 2022
 */

namespace App\Models;

use App\Traits\HasTranslations;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\MorphMany;

/**
 * Class AvailabilityHour
 * @package App\Models
 * @version January 16, 2021, 4:08 pm UTC
 *
 * @property Salon salon
 * @property string id
 * @property string day
 * @property string start_at
 * @property string end_at
 * @property string data
 * @property integer salon_id
 */
class AvailabilityHour extends Model
{

    use HasTranslations;

    /**
     * Validation rules
     *
     * @var array
     */
    public static $rules = [
        'day' => 'required|max:16',
        'start_at' => 'required|date_format:H\:i',
        'end_at' => 'required|date_format:H\:i|after:start_at',
        'data' => 'max:255',
        'salon_id' => 'required|exists:salons,id'
    ];
    public $translatable = [
        'data',
    ];
    public $timestamps = false;
    public $table = 'availability_hours';
    public $fillable = [
        'day',
        'start_at',
        'end_at',
        'data',
        'salon_id'
    ];
    /**
     * The attributes that should be casted to native types.
     *
     * @var array
     */
    protected $casts = [
        'day' => 'string',
        'start_at' => 'string',
        'end_at' => 'string',
        'data' => 'string',
        'salon_id' => 'integer'
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

    /**
     * @return array
     */
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

    /**
     * @return MorphMany
     */
    public function customFieldsValues(): MorphMany
    {
        return $this->morphMany('App\Models\CustomFieldValue', 'customizable');
    }

    /**
     * @return BelongsTo
     **/
    public function salon(): BelongsTo
    {
        return $this->belongsTo(Salon::class, 'salon_id', 'id');
    }

    public static function availabilityHour()
    {
        return [
            'morning' => [
                '06_00' => "6:00 AM",
                '06_30' => "6:30 AM",
                '07_00' => "7:00 AM",
                '07_30' => "7:30 AM",
                '08_00' => "8:00 AM",
                '08_30' => "8:30 AM",
                '09_00' => "9:00 AM",
                '09_30' => "9:30 AM",
                '10_00' => "10:00 AM",
                '10_30' => "10:30 AM",
                '11_00' => "11:00 AM",
                '11_30' => "11:30 AM",
            ],
            'afternoon' => [
                '13_00' => "01:00 PM",
                '13_30' => "01:30 PM",
                '14_00' => "02:00 PM",
                '14_30' => "02:30 PM",
                '15_00' => "03:00 PM",
                '15_30' => "03:30 PM",
                '16_00' => "04:00 PM",
                '16_30' => "04:30 PM",
                '17_00' => "05:00 PM",
                '17_30' => "05:30 PM",
            ],
            'evening' => [
                '18_00' => "06:00 PM",
                '18_30' => "06:30 PM",
                '19_00' => "07:00 PM",
                '19_30' => "07:30 PM",
                '20_00' => "08:00 PM",
                '20_30' => "08:30 PM",
            ],

            'timeslots' => [
                '06_00',
                '06_30',
                '07_00',
                '07_30',
                '08_00',
                '08_30',
                '09_00',
                '09_30',
                '10_00',
                '10_30',
                '11_00',
                '11_30',
                '13_00',
                '13_30',
                '14_00',
                '14_30',
                '15_00',
                '15_30',
                '16_00',
                '16_30',
                '17_00',
                '17_30',
                '18_00',
                '18_30',
                '19_00',
                '19_30',
                '20_00',
                '20_30',
            ]
        ];
    }
}
