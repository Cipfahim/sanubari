<?php

namespace App\Http\Requests\Users;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class UpdateRequest extends FormRequest
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
            'name' => ['required', 'string', 'min:3', 'max:255'],
            'photo' => ['nullable', 'image'],
            'role' => ['required'],
            'phone' => [
                'required', 'string', 'min:3', 'max:255',
                'regex:/^(\+?6?01)[0|1|2|3|4|6|7|8|9]\-*[0-9]{7,8}$/',
                Rule::unique('users')->where(function ($query) {
                    return $query->where('phone', request('phone'))->where('id', '!==', request()->route('user'));
                })
            ],
            'password' => ['nullable', 'string', 'min:3', 'max:255']
        ];
    }
}
