<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;



class Anexo extends Model
{
    protected $table = 'tb_anexo';
    protected $primaryKey = 'cd_anexo';
    public $timestamps = false;

    protected $fillable = [
        'cd_anexo','cd_arquivo','cd_solicitacao','cd_sub_solicitacao','ds_arquivo',
        'ds_observacoes','no_arquivo','nr_tamanho_arquivo','st_aprovacao',
        'dt_arquivo','dt_insercao','nr_matricula','dt_exclusao','nr_matricula_exclusao'
    ];

    public function solicitacao()
    {
        return $this->belongsTo(Solicitacao::class, 'cd_solicitacao');
    }
}
