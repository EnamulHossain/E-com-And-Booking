<?php

namespace App\Http\Requests;

use App\Models\Hotel;
use Illuminate\Foundation\Http\FormRequest;

class CreateHotelRequest extends FormRequest
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
        return Hotel::$rules;
    }
    public function validationData(): array
    {
        if (!auth()->user()->hasRole('admin')) {
            $this->offsetUnset('accepted');
        }
        return parent::validationData();
    }
}
