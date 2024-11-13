<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class ExhibitionRequest extends FormRequest
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
            'product_name' => 'required',
            'product_description' => 'required', 'max:255',
            'product_image' => 'required', 'mimes:jpeg,png',
            'product_price' => 'required', 'integer', 'min:0',
            'product_category' => 'required',
            'condition' => 'required', 
        ];
    }
}
