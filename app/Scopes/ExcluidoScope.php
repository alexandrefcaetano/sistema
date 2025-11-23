<?php

namespace App\Scopes;

use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Scope;
use Illuminate\Support\Facades\Schema;

class ExcluidoScope implements Scope
{
    public function apply(Builder $builder, Model $model)
    {
        // Verifica se a tabela tem a coluna 'excluido'
        if (Schema::hasColumn($model->getTable(), 'excluido')) {
            $builder->where($model->getTable() . '.excluido', false);
        }
    }
}
