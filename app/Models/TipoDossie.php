<?php


namespace App\Models;
use Illuminate\Database\Eloquent\Model;


class TipoDossie extends Model
{
    protected $table = 'tb_tipo_dossie';
    protected $primaryKey = 'cd_tipo_dossie';
    public $timestamps = false;

    protected $fillable = [
        'no_tipo_dossie',
        'st_ativo'
        ];

    public function dossiesContas()
    {
        return $this->hasMany(Dossie::class, 'cd_tipo_dossie');
    }

}

