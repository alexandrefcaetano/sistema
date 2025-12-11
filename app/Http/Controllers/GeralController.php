<?php

namespace App\Http\Controllers;

use App\Models\EmpresaDependente;

class GeralController extends Controller
{
    public function dependencias($cod)
    {
        // Validação manual
        if (!is_numeric($cod) || $cod <= 0) {
            return response()->json(['error' => 'O código informado é inválido.'], 422);
        }

        $dep = EmpresaDependente::where('cd_dependencia', $cod)->first();
        if (!$dep) {
            return response()->json(['error' => 'Dependência não encontrada.'], 404);
        }
        return response()->json($dep);
    }

}
