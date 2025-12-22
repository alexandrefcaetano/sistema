<?php


namespace App\Models;
use Illuminate\Database\Eloquent\Model;


class TipoDocumentoDossie extends Model
{
    protected $table = 'tb_tipo_documento_dossie';
    protected $primaryKey = 'cd_tipo_documento_dossie';
    public $timestamps = false;

    protected $fillable = [
        'no_tipo_documento_dossie',
        'ds_tipo_documento_dossie',
        'st_ativo'
        ];


    public function dossiesContas()
    {
        return $this->hasMany(Dossie::class, 'cd_tipo_documento_dossie');
    }

}

