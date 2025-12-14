<?php


namespace App\Models;
use Illuminate\Database\Eloquent\Model;


class TipoDossie extends Model
{
    protected $table = 'TB_TIPO_DOSSIE';
    protected $primaryKey = 'CD_TIPO_DOSSIE';
    public $timestamps = false;

    protected $fillable = [
        'NO_TIPO_DOSSIE',
        'ST_ATIVO'
        ];

    public function dossiesContas()
    {
        return $this->hasMany(Dossie::class, 'CD_TIPO_DOSSIE');
    }

}

