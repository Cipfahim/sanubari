<?php

namespace App\Http\Requests\Employees;

use Illuminate\Foundation\Http\FormRequest;

class SalaryDetailsRequest extends FormRequest
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
            'basic_salary' => ['required', 'max:7'],
            'living_allowance' => ['required', 'max:6'],
            'attendance_allowance' => ['required', 'max:6'],
            'levy' => ['required', 'max:6'],
            'in_charge_allowance' => ['required', 'max:6'],
        ];
    }
}
