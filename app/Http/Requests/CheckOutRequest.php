<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class CheckOutRequest extends FormRequest
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
            'first_name' => 'required|string|max:50',
            'last_name' => 'required|string|max:50',
            'phone' => 'required',
            'email' => 'sometimes|max:50',
            'shipping' => 'required|exists:shippings,id|max:50',
            'state' => 'required|string|max:50',
            'address1' => 'required|string|max:100',
            'notes' => 'sometimes|max:500',
        ];
    }

    public function messages()
    {
        return [
            'required' => __('messages.required'),
            'exists' => __('messages.empty-warning'),
//            'max' => __('messages.max.num')
        ];
    }
}
