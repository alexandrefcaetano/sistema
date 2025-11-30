<?php

namespace App\Http\Requests\Ted;

use Illuminate\Foundation\Http\FormRequest;

class TedStoreRequest extends FormRequest
{
    public function authorize(): bool { return true; }

    public function rules(): array
    {
        return [
            'cd_solicitacao' => 'required|integer',
            'nr_agencia' => 'required|integer',
            'nr_conta' => 'required|string',
            'dt_emissao' => 'nullable|date'
        ];
    }
}
