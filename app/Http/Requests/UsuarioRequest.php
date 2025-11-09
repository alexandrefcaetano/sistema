<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;
use App\Models\Usuario;

class UsuarioRequest extends FormRequest
{
    public function authorize(): bool
    {
        return true;
    }

    public function rules(): array
    {
        // Pega o ID do usuário da rota (compatível com rotas tipo usuario/{id})
        $userId = $this->route('id');

        $rules = [
            'name'             => 'required|string|max:100',
            'email'            => [
                'required',
                'email',
                Rule::unique('usuario', 'email')->ignore($userId), // tabela 'usuario'
            ],
            'status'           => 'required|string|max:2',
            'contato'          => 'required|json',
            'cpf'              => 'required|string|max:14',
            'data_nascimento'  => 'required|date_format:d/m/Y',
            'sexo'             => 'required|string|max:2',
        ];

        // Cadastro (store)
        if ($this->isMethod('post')) {
            $rules['password'] = 'required|string|min:6|confirmed';
        }

        // Edição (update)
        if ($this->isMethod('put') || $this->isMethod('patch')) {
            if ($this->filled('password') && $this->input('password') !== '********') {
                $rules['password'] = 'string|min:6|confirmed';
            }
        }

        return $rules;
    }

    protected function prepareForValidation(): void
    {
        // Normaliza o formato da data de nascimento
        $data = $this->input('data_nascimento');

        if ($data) {
            $data = trim($data);
            // Corrige o formato da data (era 'd/m/yyyy', o correto é 'd/m/Y')
            $date = \DateTime::createFromFormat('d/m/Y', $data);

            if ($date) {
                $this->merge([
                    'data_nascimento' => $date->format('Y-m-d'),
                ]);
            }
        }

        // Define a senha padrão ao criar novo usuário
        if ($this->isMethod('post')) {
            $this->merge([
                'password' => $this->input('password', Usuario::SENHA_PADRAO),
            ]);
        }
    }

    public function messages(): array
    {
        return [
            'name.required'             => 'O nome é obrigatório.',
            'email.required'            => 'O e-mail é obrigatório.',
            'email.email'               => 'Informe um e-mail válido.',
            'email.unique'              => 'Este e-mail já está cadastrado.',
            'status.required'           => 'O status é obrigatório.',
            'contato.required'          => 'O campo de contato é obrigatório.',
            'contato.json'              => 'O formato do contato é inválido.',
            'cpf.required'              => 'O CPF é obrigatório.',
            'cpf.max'                   => 'O CPF deve ter no máximo :max caracteres.',
            'data_nascimento.required'  => 'A data de nascimento é obrigatória.',
            'data_nascimento.date_format' => 'Informe a data de nascimento no formato dia/mês/ano (ex: 10/11/2025).',
            'sexo.required'             => 'O sexo é obrigatório.',
            'sexo.max'                  => 'O campo sexo deve ter no máximo :max caracteres.',
            'password.required'         => 'A senha é obrigatória.',
            'password.min'              => 'A senha deve ter no mínimo :min caracteres.',
            'password.confirmed'        => 'A confirmação da senha não confere.',
        ];
    }
}
