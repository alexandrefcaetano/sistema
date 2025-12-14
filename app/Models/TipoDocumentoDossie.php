<?php


namespace App\Models;
use Illuminate\Database\Eloquent\Model;


class TipoDocumentoDossie extends Model
{
    protected $table = 'TB_TIPO_DOCUMENTO_DOSSIE';
    protected $primaryKey = 'CD_TIPO_DOCUMENTO_DOSSIE';
    public $timestamps = false;

    protected $fillable = [
        'NO_TIPO_DOCUMENTO_DOSSIE',
        'DS_TIPO_DOCUMENTO_DOSSIE',
        'ST_ATIVO'
        ];


    public function dossiesContas()
    {
        return $this->hasMany(Dossie::class, 'CD_TIPO_DOCUMENTO_DOSSIE');
    }

}

