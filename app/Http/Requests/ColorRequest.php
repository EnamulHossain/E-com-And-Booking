<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class ColorRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        return true; // You can define authorization logic here if needed
    }

    public function rules()
    {
        return [
            'color' => 'required|unique:colors,color,',
        ];
    }

    public function messages()
    {
        return [
            'color.required' => 'The color field is required.',
            'color.unique' => 'The color has already been taken.',
        ];
    }
}
