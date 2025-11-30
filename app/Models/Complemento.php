<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;



class Complemento extends Model
{
    protected $table = 'tb_complemento';
    protected $primaryKey = 'cd_complemento';
    public $timestamps = false;

    protected $fillable = [
        'cd_complemento', 'cd_solicitacao', 'ds_obs', 'dt_complemento',
        'st_complemento', 'nr_matricula', 'cd_status_solicitacao', 'cd_tipo_complemento'
    ];

    public function solicitacao()
    {
        return $this->belongsTo(Solicitacao::class, 'cd_solicitacao');
    }

    public function status()
    {
        return $this->belongsTo(StatusSolicitacao::class, 'cd_status_solicitacao');
    }
}
