<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;



class Aplicacao extends Model
{
    protected $table = 'tb_aplicacao';
    protected $primaryKey = 'cd_aplicacao';
    public $timestamps = false;

    protected $fillable = ['no_aplicacao','no_rota','st_aplicacao'];

    const STATUS_ATIVO = 'A';
    const STATUS_BLOQUEADO = 'B';
    const STATUS_INATIVO = 'I';

    public function getStatusBadgeAttribute()
    {
        return match ($this->st_aplicacao) {
            self::STATUS_ATIVO     => '<span class="label label-success">Ativo</span>',
            self::STATUS_BLOQUEADO => '<span class="label label-warning">Bloqueado</span>',
            self::STATUS_INATIVO   => '<span class="label label-danger">Inativo</span>',
            default                => '<span class="label label-default">Desconhecido</span>',
        };
    }

    public function solicitacoes()
    {
        return $this->hasMany(Solicitacao::class, 'cd_aplicacao', 'cd_aplicacao');
    }

}
