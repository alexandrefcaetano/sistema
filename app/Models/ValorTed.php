<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ValorTed extends Model
{
    protected $table = 'tb_valor_ted';
    protected $primaryKey = 'cd_valor_ted';
    public $timestamps = false;

    protected $fillable = ['cd_valor_ted', 'cd_ted', 'vl_ted'];

    public function ted()
    {
        return $this->belongsTo(Ted::class, 'cd_ted');
    }
}
