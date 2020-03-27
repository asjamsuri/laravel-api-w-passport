<?php

namespace App\Http\Requests\Auth;

use Illuminate\Foundation\Http\FormRequest;

class AuthLoginRequest extends FormRequest
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
            'username' => ['required', 'string', 'email'],
            'password' => ['required', 'string']
        ];
    }

    /**
     * Get the validation messages
     * 
     * @return array
     */
    public function messages()
    {
        return [
            '{someKey}.required' => 'The {someKey} is required.'
        ];
    }
}
