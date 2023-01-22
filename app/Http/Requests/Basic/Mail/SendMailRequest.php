<?php

namespace App\Http\Requests\Basic\Mail;

use Illuminate\Foundation\Http\FormRequest;

class SendMailRequest extends FormRequest
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

            'name'=>'required|string',
            'email'=>'required|email',
            'message'=>'required|string|min:5',
        ];
    }

    public function messages()
    {
        return parent::messages();
    }
}
