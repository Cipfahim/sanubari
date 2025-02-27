<?php

namespace App\Http\Requests\Employees;

use Illuminate\Foundation\Http\FormRequest;

class ContributionRequest extends FormRequest
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
            'epf_employee' => ['required'],
            'epf_employer' => ['required'],
            'socso_group' => ['required'],
            'epf_no' => ['required', 'max:8'],
        ];
    }
}
