<?php


namespace App\Traits;

trait Auditavel
{
    public static function bootAuditavel()
    {
        static::creating(function ($model) {
            if (auth()->check()) {
                $model->nr_matricula_create = auth()->user()->nr_matricula ?? null;
            }

            $model->dt_create = now();
        });

        static::updating(function ($model) {
            if (auth()->check()) {
                $model->nr_matricula_atualizacao = auth()->user()->nr_matricula ?? null;
            }

            $model->dt_update = now();
        });
    }
}
