<?php

namespace App\Http\Requests\ValoTed;

use Illuminate\Foundation\Http\FormRequest;

class ValorTedStoreRequest extends FormRequest
{
    public function authorize(): bool { return true; }

    public function rules(): array {
        return [
            'cd_ted' => 'required|integer',
            'vl_ted' => 'required|numeric'
        ];
    }
}
