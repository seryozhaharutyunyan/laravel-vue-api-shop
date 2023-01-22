<?php

namespace App\Http\Requests\Admin\User;

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
            'name'=>'required|string|min:2',
            'last_name'=>'required|string|min:2',
            'email'=>'required|email|unique:App\Models\User',
            'pone'=>'required|regex:/(\+7)[0-9]{9}/|unique:App\Models\User',
            'city_id'=>'required|integer|exists:cities,id',
            'age'=>'required|date',
            'gender'=>'required|string',
            'address'=>'required|string|min:5',
            'edge_id'=>'required|integer|exists:edges,id',
        ];

    }

    public function messages()
    {
        return parent::messages();
    }
}
