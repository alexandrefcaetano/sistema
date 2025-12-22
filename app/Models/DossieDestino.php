<?php


namespace App\Models;
use Illuminate\Database\Eloquent\Model;


class DossieDestino extends Model
{
    protected $table = 'tb_dossie_destino';
    protected $primaryKey = 'cd_dossie_destino';
    public $timestamps = false;

    protected $fillable = [
        'ds_dossie_destino',
        'st_ativo'
    ];

    public function dossiesContas()
    {
        return $this->hasMany(Dossie::class, 'cd_dossie_destino');
    }

}

