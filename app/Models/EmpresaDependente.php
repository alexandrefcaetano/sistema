<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class EmpresaDependente extends Model
{
    protected $table = 'vw_empresa_dependente';

    // A view não possui chave primária → desabilitar
    protected $primaryKey = null;
    public $incrementing = false;

    // Se a view não possui created_at / updated_at
    public $timestamps = false;

    // Campos permitidos
    protected $fillable = [
        'cd_dependencia',
        'nm_dependencia',
    ];
}
