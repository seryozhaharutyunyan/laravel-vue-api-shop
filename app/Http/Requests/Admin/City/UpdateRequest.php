<?php

namespace App\Http\Requests\Admin\City;

use Illuminate\Foundation\Http\FormRequest;

class UpdateRequest extends FormRequest
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
            'edge_id'=>'required|integer|exists:edges,id',
            'region_id'=>'nullable|integer|exists:regions,id',
        ];
    }

    public function messages()
    {
        return parent::messages();
    }
}
