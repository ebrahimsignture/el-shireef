<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class EventRequest extends FormRequest
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
//             'title' => 'required',
//             'description' => 'required|min:5|max:255',
            'image' => 'required',
//             'type' => 'required',
//             'post_id' => 'required_if:type,post',
//             'url' => 'required_if:type,external',
//             'product_id' => 'required_if:type,product',
//             'service_id' => 'required_if:type,service',
//             'project_id' => 'required_if:type,project',
            'status'=>'required|in:active,inactive',
//            'is_featured'=>'required|in:featured,Not',
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
