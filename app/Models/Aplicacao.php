<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;



class Aplicacao extends Model
{
    protected $table = 'tb_aplicacao';
    protected $primaryKey = 'cd_aplicacao';
    public $timestamps = false;

    protected $fillable = [
        'no_aplicacao',
        'no_tipo',
        'cd_tipo_aplicacao',
        'ds_email_gestor',
        'no_apelido_email_gestor',
        'no_gestor',
        'nr_telefone_gestor',
        'st_aplicacao'
    ];
}
