<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class ModuleRequest extends FormRequest
{
    public function authorize(): bool
    {
        return true;
    }

    public function rules()
    {
        $id = $this->route('id'); // só existe em update

        return [
            'name' => [
                'required',
                'string',
                'max:120',
                Rule::unique('modules', 'name')->ignore($id),
            ],
            'display_name' => 'required|string|max:120',
            'abilities' => 'array'
        ];
    }

}
