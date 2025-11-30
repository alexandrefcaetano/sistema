<?php


namespace App\Http\Requests\Anexo;


use Illuminate\Foundation\Http\FormRequest;


class AnexoRequest extends FormRequest
{
    public function authorize(): bool { return true; }


    public function rules(): array
    {
        return [
            'cd_arquivo' => 'required|string',
            'cd_solicitacao' => 'required|integer',
            'ds_sub_solicitacao' => 'nullable|string',
            'ds_arquivo' => 'nullable|string',
            'no_arquivo' => 'nullable|string',
        ];
    }
}
