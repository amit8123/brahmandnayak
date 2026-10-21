<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class EnquiryRequest extends FormRequest
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
                    'mobile' => 'required',
                    'email' => 'required',
                    'comment' => 'required'
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
            'name.required' => 'Please enter a name',
            'mobile.required' => 'Please enter a mobile number',
            'email.required' => 'Please select a email ',
            'comment.required' => 'Please enter comment ',
        ];
    }
}
