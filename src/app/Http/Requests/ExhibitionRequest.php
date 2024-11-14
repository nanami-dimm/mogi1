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

    public function messages()
    {
        return [
            'product_name.required' => '商品名を入力してください',
            'product_description.required' => '商品の説明を入力してください',
            'product_description.max' => '255文字以内で入力してください',
            'product_image.required' => '商品画像をアップロードしてください',
            'product_image.mimes' => '拡張子が.jpegまたは.pngの画像をアップロードしてください',
            'product_price.required' => '商品の値段を入力してください',
            'product_price.integer' => '数字で入力してください',
            'product_price.min' => '0円以上で入力してください',
            'product_category.required' => 'カテゴリーを選択してください',
            'condition.required' => '商品の状態を選択してください',
        ];
    }
}
