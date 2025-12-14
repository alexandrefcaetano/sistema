<?php


namespace App\Models;
use Illuminate\Database\Eloquent\Model;


class DossieDestino extends Model
{
    protected $table = 'TB_DOSSIE_DESTINO';
    protected $primaryKey = 'CD_DOSSIE_DESTINO';
    public $timestamps = false;

    protected $fillable = [
        'DS_DOSSIE_DESTINO',
        'ST_ATIVO'
    ];

    public function dossiesContas()
    {
        return $this->hasMany(Dossie::class, 'CD_DOSSIE_DESTINO');
    }

}

