<?php

namespace App\Http\Requests\Employees;

use Illuminate\Foundation\Http\FormRequest;

class UpdateIdentificationDetailsRequest extends FormRequest
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
        return [
            'citizenship' => ['required'],
            'identity_card_number' => ['required_if:citizenship,Malaysian'],
            'passport_number' => ['required'],
            'date_of_birth' => ['required'],
            'country_of_birth' => ['required'],
            'state_of_birth' => ['required'],
            'sex' => ['required'],
        ];
    }
}
