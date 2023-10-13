<?php
/*
 * File name: Currency.php
 * Last modified: 2022.02.02 at 19:14:31
 * Author: Nefold - https://nefold.com
 * Copyright (c) 2022
 */

namespace App\Models;

use App\Traits\HasTranslations;
use Illuminate\Database\Eloquent\Model;

/**
 * Class Currency
 * @package App\Models
 * @version October 22, 2019, 2:46 pm UTC
 *
 * @property int id
 * @property string name
 * @property string symbol
 * @property string code
 * @property integer decimal_digits
 * @property integer rounding
 */
class Currency extends Model
{
    use HasTranslations;

    /**
     * Validation rules
     *
     * @var array
     */
    public static $rules = [
        'name' => 'required',
        'symbol' => 'required',
        'code' => 'required',
    ];
    public $translatable = [
        'name',
        'symbol',
        'code',
    ];
    public $table = 'currencies';
    public $fillable = [
        'name',
        'symbol',
        'code',
        'decimal_digits',
        'rounding'
    ];
    /**
     * The attributes that should be casted to native types.
     *
     * @var array
     */
    protected $casts = [
        'name' => 'string',
        'symbol' => 'string',
        'code' => 'string'
    ];
    /**
     * New Attributes
     *
     * @var array
     */
    protected $appends = [
        'custom_fields',
        'name_symbol',

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

    public function getNameSymbolAttribute()
    {
        return $this->name . ' - ' . $this->symbol;
    }


}
