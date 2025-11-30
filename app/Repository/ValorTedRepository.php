<?php

namespace App\Repository;

use App\Models\ValorTed;


class ValorTedRepository
{


    /**
     * Instância do model ValorTed.
     *
     * @var \App\Models\Solicitacao
     */
    protected $model;

    /**
     * Construtor da classe.
     *
     * @param  \App\Models\ValorTed  $model
     */
    public function __construct(ValorTed $model)
    {
        $this->model = $model;
    }

    public function paginate(int $perPage = 15)
    {
        return ValorTed::with(['teds.valores','anexos','complementos','status'])->paginate($perPage);
    }

    public function find(int $id)
    {
        return ValorTed::with(['teds.valores','anexos','complementos','status'])->findOrFail($id);
    }

    public function create(array $data)
    {
        return ValorTed::create($data);
    }

    public function update(int $id, array $data)
    {
        $m = ValorTed::findOrFail($id);
        $m->update($data);
        return $m;
    }

    public function delete(int $id)
    {
        $m = ValorTed::findOrFail($id);
        return $m->delete();
    }
}
