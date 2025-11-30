<?php

namespace App\Repository;

use App\Models\Complemento;


class ComplementoRepository
{


    /**
     * Instância do model Usuario.
     *
     * @var \App\Models\Complemento
     */
    protected $model;

    /**
     * Construtor da classe.
     *
     * @param  \App\Models\Complemento  $model
     */
    public function __construct(Complemento $model)
    {
        $this->model = $model;
    }

    public function paginate(int $perPage = 15)
    {
        return Complemento::with(['teds.valores','anexos','complementos','status'])->paginate($perPage);
    }

    public function find(int $id)
    {
        return Complemento::with(['teds.valores','anexos','complementos','status'])->findOrFail($id);
    }

    public function create(array $data)
    {
        return Complemento::create($data);
    }

    public function update(int $id, array $data)
    {
        $m = Complemento::findOrFail($id);
        $m->update($data);
        return $m;
    }

    public function delete(int $id)
    {
        $m = Complemento::findOrFail($id);
        return $m->delete();
    }
}
