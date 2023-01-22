<?php

namespace App\Http\Requests\Aut\Registration;

use Illuminate\Foundation\Http\FormRequest;

class UpdateAccountRequest extends FormRequest
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
            'password'=>'required|string|min:8',
            'city_id'=>'required|integer|exists:cities,id',
            'address'=>'required|string|min:5',
            'edge_id'=>'required|integer|exists:edges,id',
            'img'=>'nullable|file'
        ];

    }

    public function messages()
    {
        return parent::messages();
    }
}
