<?php

namespace App\Http\Requests\Ted;

use Illuminate\Foundation\Http\FormRequest;

class TedUpdateRequest extends FormRequest
{
    public function authorize(): bool { return true; }

    public function rules(): array
    {
        return [
            'cd_solicitacao' => 'nullable|integer',
            'nr_agencia' => 'nullable|integer',
            'nr_conta' => 'nullable|string',
            'dt_emissao' => 'nullable|date'
        ];
    }
}
