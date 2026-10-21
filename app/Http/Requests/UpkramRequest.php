<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class UpkramRequest extends FormRequest
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
                    'icon' => 'required',
                    'bg-color' => 'required',
                    'title' => 'required',
                    'mohim-body' => 'required',
                ];
                break;

            case 'PATCH':
                return [
                    'icon' => 'required',
                    'bg-color' => 'required',
                    'title' => 'required',
                    'mohim-body' => 'required',
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
            'icon.required' => 'An Icon is required',
            'bg-color.required' => 'A Background color is required',
            'title.required' => 'A Vishesh mohim Title is required',
            'mohim-body.required' => 'A Mohim Detail is required',
        ];
    }
}
