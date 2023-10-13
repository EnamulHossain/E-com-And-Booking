<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class ShippingRulesRequest extends FormRequest
{
    public function authorize()
    {
        return true; // You can define authorization logic here if needed.
    }

    public function rules()
    {
        return [
            'shipping_companies_id' => 'required|integer',
            'address_id' => 'required|integer',
            'price_for_location' => 'required|numeric',
            'weight' => 'required|numeric',
            'price_for_weight' => 'required|numeric',
        ];
    }

    public function messages()
    {
        return [
            'shipping_companies_id.required' => 'The shipping companies ID is required.',
            'address_id.required' => 'The address ID is required.',
            'price_for_location.required' => 'The price for location is required.',
            'weight.required' => 'The weight is required.',
            'price_for_weight.required' => 'The price for weight is required.',
            'shipping_companies_id.integer' => 'The shipping companies ID must be an integer.',
            'address_id.integer' => 'The address ID must be an integer.',
            'price_for_location.numeric' => 'The price for location must be a numeric value.',
            'weight.numeric' => 'The weight must be a numeric value.',
            'price_for_weight.numeric' => 'The price for weight must be a numeric value.',
        ];
    }
}