<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class CommentRequest extends FormRequest
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
            'product_comment' => 'required', 'max:255',
        ];
    }

    public function messages()
    {
        return [
            'product_comment.required' => 'コメントを入力してください',
            'product_comment.max' => '255文字以内で入力してください',
        ];
    }
}