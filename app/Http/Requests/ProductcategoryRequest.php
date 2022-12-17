<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class ProductcategoryRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        // only allow updates if the user is logged in
        return backpack_auth()->check();
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        return [
            'title' => 'string|required|max:255',
//            'summary' => 'string|required|min:5|max:255',
            'description' => 'string|required|min:5|max:255',
//            'image' => 'required_without_id|mimes:jpg,jpeg,png',
            'status'=>'required|in:active,inactive',
            ];
    }

    /**
     * Get the validation attributes that apply to the request.
     *
     * @return array
     */
    public function attributes()
    {
        return [
            //
        ];
    }

    /**
     * Get the validation messages that apply to the request.
     *
     * @return array
     */
    public function messages()
    {
        return [
            //
        ];
    }
}
