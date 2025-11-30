<?php

namespace App\Http\Requests\Aplicacao;

use Illuminate\Foundation\Http\FormRequest;

class AplicacaoStoreRequest extends FormRequest
{
    public function authorize(): bool { return true; }

    public function rules(): array
    {
        return [
            'cd_solicitacao' => 'required|integer',
            'nr_matricula' => 'nullable|integer',
            'dt_solicitacao' => 'nullable|date',
        ];
    }
}
