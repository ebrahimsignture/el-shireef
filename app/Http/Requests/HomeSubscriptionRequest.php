<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class HomeSubscriptionRequest extends FormRequest
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
            'subscription_email' => 'required|email|unique:subscriptions,email'
        ];
    }
    public function messages()
    {
        return [
            'subscription_email.required' => __('messages.required'),
            'subscription_email.email' => __('messages.subscribe.email'),
            'subscription_email.unique' => __('messages.subscribe.unique'),
        ];
    }
}
