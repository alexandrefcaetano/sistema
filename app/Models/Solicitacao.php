<?php


namespace App\Models;


use Illuminate\Database\Eloquent\Model;


class Solicitacao extends Model
{
    protected $table = 'tb_solicitacao';
    protected $primaryKey = 'cd_solicitacao';
    public $incrementing = false;
    public $timestamps = false;


    protected $fillable = [
        'cd_solicitacao','nr_matricula','nr_tipo','dt_solicitacao','nr_agencia',
        'no_unidade','nr_telefone','st_solicitacao','dt_atualizacao','cd_tipo_solicitacao',
        'cd_status_solicitacao','cd_aplicacao','no_gerente','cd_dependencia','cd_empresa',
        'nr_matricula_atualizacao','nr_matricula_funcionario','nr_conta','ds_chave_negocio'
    ];


    public function teds()
    {
        return $this->hasMany(Ted::class, 'cd_solicitacao', 'cd_solicitacao');
    }


    public function anexos()
    {
        return $this->hasMany(Anexo::class, 'cd_solicitacao', 'cd_solicitacao');
    }


    public function complementos()
    {
        return $this->hasMany(Complemento::class, 'cd_solicitacao', 'cd_solicitacao');
    }


    public function status()
    {
        return $this->belongsTo(StatusSolicitacao::class, 'cd_status_solicitacao', 'cd_status_solicitacao');
    }
}
