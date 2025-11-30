<?php

namespace App\Http\Requests\Complemento;

use Illuminate\Foundation\Http\FormRequest;

class ComplementoRequest extends FormRequest
{
    public function authorize(): bool { return true; }

    public function rules(): array
    {
        return [
            'cd_solicitacao' => 'required|integer',
            'ds_obs' => 'nullable|string',
            'dt_complemento' => 'nullable|date',
        ];
    }
}
