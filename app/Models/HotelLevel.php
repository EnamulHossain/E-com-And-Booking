<?php
/*
 * File name: HotelLevel.php
 * Last modified: 2022.02.03 at 14:22:04
 * Author: Nefold - https://nefold.com
 * Copyright (c) 2022
 */

namespace App\Models;

use App\Traits\HasTranslations;
use Eloquent as Model;
use Illuminate\Database\Eloquent\Relations\MorphMany;
/**
 * Class HotelLevel
 * @package App\Models
 * @version January 13, 2021, 10:56 am UTC
 *
 * @property string name
 * @property double commission
 * @property boolean disabled
 * @property boolean default
 */
class HotelLevel extends Model
{
    use HasTranslations;

    /**
     * Validation rules
     *
     * @var array
     */
    public static $rules = [
        'name' => 'required|max:127',
        'commission' => 'required|numeric|max:100|min:0'
    ];
    public $translatable = [
        'name',
    ];
    public $table = 'hotel_levels';
    public $fillable = [
        'name',
        'commission',
        'disabled',
        'default'
    ];
    /**
     * The attributes that should be casted to native types.
     *
     * @var array
     */
    protected $casts = [
        'name' => 'string',
        'commission' => 'double',
        'disabled' => 'boolean',
        'default' => 'boolean'
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


}
