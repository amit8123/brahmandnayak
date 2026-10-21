<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class SliderRequest extends FormRequest
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
                    'title' => 'required',
                    'slider-image' => 'required|mimes:png,jpg,jpeg|min:1',
                ];
                break;

            case 'PATCH':
                return [
                    'title' => 'required',
                    'slider-image' => 'mimes:png,jpg,jpeg|min:1',
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
            'title.required' => 'Please enter a Title',
            'slider-image.required' => 'Please attach an image ',
        ];
    }
}
