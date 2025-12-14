<?php

namespace App\Models;

use App\Traits\Auditavel;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;



class Complemento extends Model
{
    use Auditavel;
    protected $table = 'tb_complemento';
    protected $primaryKey = 'cd_complemento';
    public $timestamps = false;

    protected $fillable = [
        'cd_solicitacao',
        'ds_obs',
        'dt_complemento',
        'nr_matricula',
        'cd_status',
    ];

    protected $casts = [
        'dt_complemento' => 'datetime',
    ];
    public function status()
    {
        return $this->belongsTo(Status::class, 'cd_status', 'cd_status');
    }

    public function solicitacao()
    {
        return $this->belongsTo(Solicitacao::class, 'cd_solicitacao', 'cd_solicitacao');
    }

    public function usuario()
    {
        return $this->belongsTo(Usuario::class, 'nr_matricula', 'nr_matricula');
    }
}
