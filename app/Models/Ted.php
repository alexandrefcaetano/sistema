<?php

namespace App\Models;

use App\Traits\Auditavel;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;


class Ted extends Model
{
    use Auditavel;
    protected $table = 'tb_ted';
    protected $primaryKey = 'cd_ted';
    public $timestamps = false;

    protected $fillable = [
        'cd_status',
        'cd_solicitacao',
        'cd_dependencia',
        'nr_agencia',
        'no_unidade',
        'nr_telefone',
        'nr_conta',
        'dt_emissao',
        'vlr_total',
    ];
    public function status()
    {
        return $this->belongsTo(Status::class, 'cd_status', 'cd_status');
    }

    public function solicitacao()
    {
        return $this->belongsTo(Solicitacao::class, 'cd_solicitacao', 'cd_solicitacao');
    }

    public function valores()
    {
        return $this->hasMany(TedValor::class, 'cd_ted', 'cd_ted');
    }
}


