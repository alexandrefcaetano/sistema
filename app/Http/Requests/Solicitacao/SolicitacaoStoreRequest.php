<?php

namespace App\Http\Requests\Solicitacao;

use Illuminate\Foundation\Http\FormRequest;

class SolicitacaoStoreRequest extends FormRequest
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
