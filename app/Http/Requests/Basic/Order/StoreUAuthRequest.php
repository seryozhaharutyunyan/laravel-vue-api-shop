<?php

namespace App\Http\Requests\Basic\Order;

use Illuminate\Foundation\Http\FormRequest;

class StoreUAuthRequest extends FormRequest
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
            'user_id'=>'nullable|integer|exists:users,id',
            'price'=>'required|integer',
            'quantity'=>'required|integer',
            'address'=>'required|string|min:5',
            'edge_id'=>'required|integer|exists:edges,id',
            'city_id'=>'required|integer|exists:cities,id',
        ];
    }

    public function messages()
    {
        return parent::messages();
    }
}
