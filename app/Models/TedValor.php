<?php

namespace App\Models;

use App\Traits\Auditavel;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class TedValor extends Model
{
    use Auditavel;
    protected $table = 'tb_valores_ted';
    protected $primaryKey = 'cd_valor_ted';
    public $timestamps = false;

    protected $fillable = ['cd_valor_ted', 'cd_ted', 'vlr_ted'];

    public function ted()
    {
        return $this->belongsTo(Ted::class, 'cd_ted', 'cd_ted');
    }
}
