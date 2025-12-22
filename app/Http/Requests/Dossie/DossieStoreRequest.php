<?php

namespace App\Http\Requests\Dossie;

use Illuminate\Foundation\Http\FormRequest;

class DossieStoreRequest extends FormRequest
{
    public function authorize(): bool
    {
        return true;
    }

    public function rules(): array
    {
        return [
            'cd_dossie_destino' => ['required', 'integer'],
            'cd_dependencia'    => ['required', 'integer'],
            'no_unidade'        => ['required', 'string'],
            'nr_conta'          => ['required', 'string'],
            'dt_emissao'        => ['required', 'date'],

            'cd_produto_conta'  => ['required', 'integer'],
            'cd_especie_conta'  => ['required', 'integer'],
            'dn_cpf_cnpj'       => ['required', 'string'],

            'ds_chave_negocio'  => ['nullable', 'string'],
            'cd_status'         => ['nullable', 'integer'],
            'nr_telefone'       => ['nullable', 'string'],
            'ds_obs'            => ['nullable', 'string'],

            /**
             * ANEXOS
             * - Pode ter vários
             * - Pelo menos 1 é obrigatório
             * - Somente PDF
             * - Máximo 10MB por arquivo
             */
            'anexo'   => ['required', 'array', 'min:1'],
            'anexo.*' => [
                'required',
                'file',
                'mimes:pdf',
                'mimetypes:application/pdf',
                'max:10240', // 10MB
            ],

            'descricao_anexo'   => ['nullable', 'array'],
            'descricao_anexo.*' => ['nullable', 'string'],
        ];
    }

    public function messages(): array
    {
        return [
            'anexo.*.mimes' => 'O anexo deve ser um arquivo PDF.',
            'anexo.*.max'   => 'O anexo não pode ultrapassar 10MB.',
            'anexo.required' => 'É obrigatório enviar pelo menos um anexo.',
        ];
    }
}
