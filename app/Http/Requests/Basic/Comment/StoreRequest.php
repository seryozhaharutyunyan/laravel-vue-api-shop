<?php

namespace App\Http\Requests\Basic\Comment;

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

            'product_id'=>'required|integer|exists:products,id',
            'user_id'=>'required|integer|exists:users,id',
            'comment'=>'required|string|min:5',
        ];
    }

    public function messages()
    {
        return parent::messages();
    }
}
