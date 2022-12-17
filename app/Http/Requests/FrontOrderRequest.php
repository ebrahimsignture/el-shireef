<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class FrontOrderRequest extends FormRequest
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
            'name' => 'required|string|max:100',
            'email' => 'required|email|max:50',
            'phone' => 'required|max:15',
//            'whats_app' => 'required|max:15',
            'services' => 'required',
            'details' => 'sometimes',
//            'user_id' => 'required',
        ];
    }

    public function messages()
    {
        return [
            'required' => 'هذا الحقل مطلوب',
            'string' => 'هذا الحقل من نوع نصوص وأرقام',
            'max' => 'لقد تخطيت الحد الأقصي للحروف',
            'email' => 'بريد الكتروني غير صالح',
        ];
    }
}
