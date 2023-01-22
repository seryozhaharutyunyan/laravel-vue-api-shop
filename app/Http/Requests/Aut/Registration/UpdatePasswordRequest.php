<?php

namespace App\Http\Requests\Aut\Registration;

use Illuminate\Foundation\Http\FormRequest;

class UpdatePasswordRequest extends FormRequest
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
            'passwordNew'=>'required|string|min:8|confirmed',
        ];

    }

    public function messages()
    {
        return parent::messages();
    }
}
