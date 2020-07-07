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
        Log::debug('$request');
        Log::debug($request);
        return [
            'title' => 'required|string|max:50',
            'category_id' => 'required|integer',
            'description' => 'required|string|max:140',
            'body' => 'required|string',
            'price' => 'required|integer',
            'image' => 'nullable|image|max:2048',
        ];
    }

    public function messages()
    {
        return [
            'image.image' => 'アップロードできるのは画像のみです',
            'image.max' => '画像は2MB以下のサイズにしてください。',
        ];
    }
}
