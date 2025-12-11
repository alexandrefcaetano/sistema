<?php


namespace App\Models;


use Illuminate\Database\Eloquent\Model;


class Solicitacao extends Model
{
    protected $table = 'tb_solicitacao';
    protected $primaryKey = 'cd_solicitacao';
    public $timestamps = false;

    protected $fillable = ['cd_solicitacao','cd_aplicacao' ];



    public function aplicacao()
    {
        return $this->belongsTo(Aplicacao::class, 'cd_aplicacao', 'cd_aplicacao');
    }
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

}
