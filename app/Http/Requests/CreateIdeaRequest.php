<?php

namespace inspiration\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Http\Request;

use Illuminate\Support\Facades\Log;

class CreateIdeaRequest extends FormRequest
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
    public function rules(Request $request)
    {
        return [
            'title' => 'required|string|max:50',
            'category_id' => 'required|integer',
            'description' => 'required|string|max:140',
            'body' => 'required|string',
            'price' => 'required|integer',
            'image' => 'nullable|image|max:2048',
        ];
    }

    /**
     * Get the validation messages.
     *
     * @return array
     */
    public function messages()
    {
        return [
            'title.required' => 'タイトルは入力必須です。',
            'title.string' => 'タイトルは文字列のみ有効です。',
            'title.max' => 'タイトルは50文字以内で入力してください。',
            'category_id.required' => 'カテゴリーは選択必須です。',
            'category_id.integer' => '選択されたカテゴリーが正しくありません',
            'description.required' => '説明は入力必須です。',
            'description.string' => '説明は文字列のみ有効です。',
            'description.max' => '説明は140文字以内で入力してください。',
            'body.required' => 'アイデアの内容は入力必須です。',
            'body.string' => 'アイデアの内容は文字列のみ有効です。',
            'price.required' => '金額は入力必須です。',
            'price.string' => '金額が正しくありません。',
            'image.image' => 'アップロードできるのは画像のみです',
            'image.max' => '画像は2MB以下のサイズにしてください。',
        ];
    }
}
