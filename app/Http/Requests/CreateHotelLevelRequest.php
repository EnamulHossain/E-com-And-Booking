<?php
/*
 * File name: CreateHotelLevelRequest.php
 * Last modified: 2022.02.02 at 21:19:16
 * Author: Nefold - https://nefold.com
 * Copyright (c) 2022
 */

namespace App\Http\Requests;

use App\Models\HotelLevel;
use Illuminate\Foundation\Http\FormRequest;

class CreateHotelLevelRequest extends FormRequest
{

    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        return HotelLevel::$rules;
    }
}
