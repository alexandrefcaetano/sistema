<?php


namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class RoleRequest extends FormRequest
{
    public function authorize()
    {
        return true;
    }

    public function rules()
    {
        return [
            'name' => 'required|string|max:120',
            'status' => 'required|in:AT,IN',
            'description' => 'string|max:255',
            'abilities' => 'array'
        ];
    }

    public function messages()
    {
        return [
            'name.required' => 'O nome da função é obrigatório.',
            'status.in' => 'Status inválido.'
        ];
    }
}
