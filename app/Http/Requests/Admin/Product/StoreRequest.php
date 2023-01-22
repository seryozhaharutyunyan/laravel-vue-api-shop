<?php

namespace App\Http\Requests\Admin\Product;

use Illuminate\Foundation\Http\FormRequest;

class StoreRequest extends FormRequest
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
     * @return array<string, mixed>
     */
    public function rules()
    {
        return [
            'title'=>'required|string|min:2',
            'description'=>'required|string|min:10',
            'price'=>'required|numeric',
            'quantity'=>'required|integer',
            'images'=>'required|array',
            'images.*'=>'required|file',
            'category_id'=>'required|integer|exists:categories,id',
            'tag_ids'=>'nullable|array',
            'tag_ids.*'=>'nullable|integer|exists:tags,id',
        ];
    }

    public function messages()
    {
        return parent::messages();
    }
}
