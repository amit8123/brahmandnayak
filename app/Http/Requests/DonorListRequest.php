<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class DonorListRequest extends FormRequest
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
                    'date' => 'required',
                    'name' => 'required',
                    'email' => 'required|email',
                    'amount' => 'required',
                    'transaction_id' => 'required'
                ];
                break;

            case 'PATCH':
                return [
                    'date' => 'required',
                    'name' => 'required',
                    'email' => 'required|email',
                    'amount' => 'required',
                    'transaction_id' => 'required'
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
            'date.required' => 'A date is required',
            'name.required' => 'A name is required',
            'email.required' => 'An email is required',
            'amount.required' => 'The amount is required',
            'transaction_id.required' => 'A transaction_id is required'
        ];
    }
}
