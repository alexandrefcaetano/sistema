<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;


class Ted extends Model
{
    protected $table = 'tb_ted';
    protected $primaryKey = 'cd_ted';
    public $timestamps = false;

    protected $fillable = ['cd_ted', 'cd_solicitacao', 'nr_agencia', 'nr_conta', 'dt_emissao'];

    public function solicitacao()
    {
        return $this->belongsTo(Solicitacao::class, 'cd_solicitacao');
    }

    public function valores()
    {
        return $this->hasMany(ValorTed::class, 'cd_ted');
    }
}


