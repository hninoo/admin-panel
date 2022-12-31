<?php

namespace App\Http\Requests\Api;

use Illuminate\Validation\Rule;

class RegisterRequest extends BaseRequest
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
            'name' => 'required',
            'email' => 'required|email|unique:users,email',
            'password' => 'required',
            'c_password' => 'required|same:password',
            'nickname' => 'nullable',
            'avatar' => 'nullable|mimes:jpg,bmp,png',
            'gender' => 'nullable', Rule::in(['male', 'female']),
            'age' => 'nullable|digits_between:1,100',
            'mobile' => 'nullable|regex:/^([0-9\s\-\+\(\)]*)$/|min:9',
            'interest_music_types' => 'nullable|array'
        ];
    }
}
