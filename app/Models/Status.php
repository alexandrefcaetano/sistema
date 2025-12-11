<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;


class Status extends Model
{
    protected $table = 'tb_status';
    protected $primaryKey = 'cd_status';
    public $timestamps = false;

    protected $fillable = ['no_status', 'ds_status'];

    public function teds()
    {
        return $this->hasMany(Ted::class, 'cd_status', 'cd_status');
    }

}
