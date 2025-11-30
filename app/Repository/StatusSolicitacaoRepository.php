<?php

namespace App\Repository;

use App\Models\StatusSolicitacao;


class StatussolicitacaoRepository
{


    /**
     * Instância do model Usuario.
     *
     * @var \App\Models\StatusSolicitacao
     */
    protected $model;

    /**
     * Construtor da classe.
     *
     * @param  \App\Models\StatusSolicitacao  $model
     */
    public function __construct(StatusSolicitacao $model)
    {
        $this->model = $model;
    }

    public function paginate(int $perPage = 15)
    {
        return StatusSolicitacao::with(['teds.valores','anexos','complementos','status'])->paginate($perPage);
    }

    public function find(int $id)
    {
        return StatusSolicitacao::with(['teds.valores','anexos','complementos','status'])->findOrFail($id);
    }

    public function create(array $data)
    {
        return StatusSolicitacao::create($data);
    }

    public function update(int $id, array $data)
    {
        $m = StatusSolicitacao::findOrFail($id);
        $m->update($data);
        return $m;
    }

    public function delete(int $id)
    {
        $m = StatusSolicitacao::findOrFail($id);
        return $m->delete();
    }
}
