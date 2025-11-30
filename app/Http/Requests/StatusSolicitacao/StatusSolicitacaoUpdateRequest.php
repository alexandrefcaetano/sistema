<?php

namespace App\Http\Requests\StatusSolicitacao;

use Illuminate\Foundation\Http\FormRequest;

class StatusSolicitacaoUpdateRequest extends FormRequest
{
    public function authorize(): bool { return true; }

    public function rules(): array
    {
        return [
            'no_status_solicitacao' => 'required|string',
            'ds_status_solicitacao' => 'nullable|string',
        ];
    }
}
