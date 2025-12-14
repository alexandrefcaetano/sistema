<?php

namespace App\Http\Requests\Ted;

use Illuminate\Foundation\Http\FormRequest;

class TedUpdateRequest extends FormRequest
{
    public function authorize(): bool { return true; }

    public function rules(): array
    {
        return [
            'cd_dependencia' => 'required|integer',
            'nr_conta' => 'required|string',
            'dt_emissao' => 'required|date',
            'nr_telefone' => 'nullable',
            'ds_obs'  => 'nullable',
            'no_unidade'  => 'nullable',
            'vlr_total'  => 'required',
            'nr_agencia'  => 'required',
            'cd_status'  => 'required',

            // 🔥 ESSENCIAL
            'vlr_ted'               => 'required|array|min:1',

        ];
    }
}
