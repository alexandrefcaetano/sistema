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
        $userId = $this->route('id');

        $rules = [
            'name'             => 'required|string|max:100',
            'email'            => [
                'required',
                'email',
                Rule::unique('usuario', 'email')->ignore($userId),
            ],
            'contato'          => 'required|json',
            'cpf'              => 'required|string|max:14',
            'data_nascimento'  => 'required|date_format:d/m/Y',
            'sexo'             => 'required|string|max:2',
        ];

        /**
         * CREATE (POST)
         * O status não é obrigatório porque é definido no Repository
         */
        if ($this->isMethod('post')) {

            // Senha obrigatória *somente se vier do formulário*
            if ($this->filled('password')) {
                $rules['password'] = 'required|string|min:6|confirmed';
            } else {
                // Caso não envie, usamos a senha padrão no passedValidation()
                $rules['password'] = 'nullable';
            }

            $rules['status'] = 'nullable';  // repository define
        }

        /**
         * UPDATE (PUT/PATCH)
         */
        if ($this->isMethod('put') || $this->isMethod('patch')) {

            $rules['status'] = 'required|string|max:2';

            if ($this->filled('password') && $this->input('password') !== '********') {
                $rules['password'] = 'string|min:6|confirmed';
            }
        }

        return $rules;
    }

    /**
     * Converte a data *apenas depois* da validação,
     * para não quebrar o date_format no rules()
     */
    protected function passedValidation(): void
    {
        // Trata data_nascimento: d/m/Y → Y-m-d
        $data = $this->data_nascimento;

        if ($data) {
            $date = \DateTime::createFromFormat('d/m/Y', $data);

            if ($date) {
                $this->merge([
                    'data_nascimento' => $date->format('Y-m-d'),
                ]);
            }
        }

        // No create, se não enviou senha, define a padrão
        if ($this->isMethod('post') && empty($this->password)) {
            $this->merge([
                'password' => Usuario::SENHA_PADRAO,
                'password_confirmation' => Usuario::SENHA_PADRAO,
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
