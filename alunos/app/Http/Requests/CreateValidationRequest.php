<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class CreateValidationRequest extends FormRequest
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
    public function rules()
    {
        return [
            'nome' => 'required',
            'email' => 'required|unique:alunos',
            'image' => 'nullable|mimes:jpg,png,jpeg'
        ];
    }

    public function messages()
    {
        return [
            'nome.required' => 'Campo nome deve ser preenchido',
            'email.required' => 'Campo email deve ser preenchido'
        ];
    }
}
