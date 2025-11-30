<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;


class StatusSolicitacao extends Model
{
    protected $table = 'tb_status_solicitacao';
    protected $primaryKey = 'cd_status_solicitacao';
    public $timestamps = false;

    protected $fillable = ['no_status_solicitacao', 'ds_status_solicitacao'];
}
