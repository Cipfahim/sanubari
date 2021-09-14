<?php

namespace App\Http\Requests\Employees;

use Illuminate\Foundation\Http\FormRequest;

class StoreEmployeeRequest extends FormRequest
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
            'official_name' => ['required', 'string', 'min:3', 'max:255'],
            'nick_name' => ['required', 'string', 'min:3', 'max:255'],
            'photo' => ['nullable', 'image'],
            'location' => ['required', 'numeric'],
            'date_of_join' => ['required'],
            'phone' => ['required', 'string', 'min:3', 'max:255', 'unique:users','regex:/^(\+?6?01)[0|1|2|3|4|6|7|8|9]\-*[0-9]{7,8}$/'],
            'password' => ['required', 'string', 'min:3', 'max:255']
        ];
    }
}
