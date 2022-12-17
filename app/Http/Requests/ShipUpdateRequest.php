<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class ShipUpdateRequest extends FormRequest
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
            'first_name' => 'max:50|string',
            'last_name' => 'max:50|string',
            'ship_phone' => 'max:15',
            'email' => 'email',
            'shipping_id' => 'exists:shippings,id',
            'state' => 'sometimes|string',
            'street' => 'sometimes|string',

        ];
    }


    public function messages()
    {
        return [


        ];
    }
}
