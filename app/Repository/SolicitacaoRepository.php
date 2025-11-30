<?php

namespace App\Repository;

use App\Models\Solicitacao;


class SolicitacaoRepository
{


    /**
     * Instância do model Usuario.
     *
     * @var \App\Models\Solicitacao
     */
    protected $model;

    /**
     * Construtor da classe.
     *
     * @param  \App\Models\Solicitacao  $model
     */
    public function __construct(Solicitacao $model)
    {
        $this->model = $model;
    }

    public function paginate(int $perPage = 15)
    {
        return Solicitacao::with(['teds.valores','anexos','complementos','status'])->paginate($perPage);
    }

    public function find(int $id)
    {
        return Solicitacao::with(['teds.valores','anexos','complementos','status'])->findOrFail($id);
    }

    public function create(array $data)
    {
        return Solicitacao::create($data);
    }

    public function update(int $id, array $data)
    {
        $m = Solicitacao::findOrFail($id);
        $m->update($data);
        return $m;
    }

    public function delete(int $id)
    {
        $m = Solicitacao::findOrFail($id);
        return $m->delete();
    }
}
