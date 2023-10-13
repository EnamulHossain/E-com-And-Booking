<?php
/*
 * File name: CreateHotelPayoutRequest.php
 * Last modified: 2022.02.02 at 21:20:42
 * Author: Nefold - https://nefold.com
 * Copyright (c) 2022
 */

namespace App\Http\Requests;

use App\Models\HotelPayout;
use Illuminate\Foundation\Http\FormRequest;

class CreateHotelPayoutRequest extends FormRequest
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
        return HotelPayout::$rules;
    }
}
