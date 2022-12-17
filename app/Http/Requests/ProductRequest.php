<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class ProductRequest extends FormRequest
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
            'title'=>'string|required',
            'summary'=>'string|required',
            'cover'=>'required',
            'color'=>'required',
            'description'=>'required',
            'cat_id'=>'required|exists:productcategories,id',
            'tags'=>'required|exists:tags,id',
            'price'=>'required|numeric',
            'discount'=>'nullable|numeric',
            'stock'=>'required',
            'condition'=>'sometimes|in:0,1,2',
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
