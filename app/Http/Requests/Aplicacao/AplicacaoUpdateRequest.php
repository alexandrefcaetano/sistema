<?php

namespace App\Http\Requests\Aplicacao;

use Illuminate\Foundation\Http\FormRequest;

class AplicacaoUpdateRequest extends FormRequest
{
    public function authorize(): bool { return true; }

    public function rules(): array
    {
        return [
            'nr_matricula' => 'nullable|integer',
            'dt_solicitacao' => 'nullable|date',
        ];
    }
}
