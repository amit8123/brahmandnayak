<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class AccountsRequest extends FormRequest
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
        $method = $this->method();

        switch ($method) {
            case 'GET':
            case 'DELETE':
            case 'PUT':
                return [];
                break;

            case 'POST':
                return [
                    'name' => 'required',
                    'email' => 'required|email|unique:users',
                    'mobile' => 'required|min:10|numeric',
                    'password' => 'required|min:6|regex:/^(?=.*?[A-Z])(?=.*?[a-z])(?=.*?[0-9])(?=.*?[#?!@$%^&*-]).{6,}$/',
                    'confirm-password' => 'required|min:6|regex:/^(?=.*?[A-Z])(?=.*?[a-z])(?=.*?[0-9])(?=.*?[#?!@$%^&*-]).{6,}$/|same:password',
                    'role' => 'required',
                ];
                break;

            case 'PATCH':
                return [
                    'name' => 'required',
                    'email' => 'required|email|' . Rule::unique('users')->ignore($this->id),
                    'mobile' => 'required|min:10|numeric',
                    'password' => 'nullable|min:6|regex:/^(?=.*?[A-Z])(?=.*?[a-z])(?=.*?[0-9])(?=.*?[#?!@$%^&*-]).{6,}$/',
                    'confirm-password' => 'nullable|min:6|regex:/^(?=.*?[A-Z])(?=.*?[a-z])(?=.*?[0-9])(?=.*?[#?!@$%^&*-]).{6,}$/|same:password',
                    'role' => 'required',
                ];
                break;

            default:
                break;
        }
    }

    /**
     * Modify the returned validation error messages
     *
     * @return array
     */
    public function messages()
    {
        return [
            'name.required' => 'A name is required',
            'email.required' => 'An email is required',
            'email.unique' => 'The email has already been taken',
            'email.email' => 'The email entered must be of a proper format ( example@domain.com )',
            'mobile.required' => 'A mobile number is required',
            'mobile.min' => 'The mobile number entered must be of at least 10 digits',
            'mobile.number' => 'The mobile number entered must be of a numeric format ( 0-9 )',
            'password.required' => 'A password is required',
            'password.min' => 'The password entered must be of at least 6 characters',
            'password.regex' => 'Your password should contain at-least 1 Uppercase, 1 Lowercase, 1 Numeric and 1 special character',
            'confirm-password.required' => 'A confirm password is required',
            'confirm-password.min' => 'The confirm password entered must be of at least 6 characters',
            'confirm-password.same' => 'The confirm password entered must match the password',
            'role.required' => 'A role is required',
        ];
    }
}
