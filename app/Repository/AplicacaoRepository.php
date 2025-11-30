<?php

namespace App\Repository;

use App\Models\Aplicacao;


class AplicacaoRepository
{


    /**
     * Instância do model Usuario.
     *
     * @var \App\Models\Aplicacao
     */
    protected $model;

    /**
     * Construtor da classe.
     *
     * @param  \App\Models\Aplicacao  $model
     */
    public function __construct(Aplicacao $model)
    {
        $this->model = $model;
    }

    public function paginate(int $perPage = 15)
    {
        return Aplicacao::with(['teds.valores','anexos','complementos','status'])->paginate($perPage);
    }

    public function find(int $id)
    {
        return Aplicacao::with(['teds.valores','anexos','complementos','status'])->findOrFail($id);
    }

    public function create(array $data)
    {
        return Aplicacao::create($data);
    }

    public function update(int $id, array $data)
    {
        $m = Aplicacao::findOrFail($id);
        $m->update($data);
        return $m;
    }

    public function delete(int $id)
    {
        $m = Aplicacao::findOrFail($id);
        return $m->delete();
    }
}
