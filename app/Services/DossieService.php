<?php

namespace App\Services;

use App\Models\Solicitacao;
use App\Models\TedValor;
use App\Repository\DossieRepository;
use Illuminate\Support\Facades\DB;

class DossieService
{
    public function __construct(
        private DossieRepository $repo
    ) {}


    /**
     * Retorna todos os teds (sem paginação).
     *
     * @return \Illuminate\Support\Collection
     */
    public function listAll()
    {
        return $this->repo->getAll();
    }

    /**
     * Retorna um ted pelo ID.
     *
     * @param  int  $id
     * @return \App\Models\Ted
     */
    public function getById($id)
    {
        return $this->repo->find($id);
    }


    /**
     * Cria uma nova função (Dossie) com os dados informados.
     *
     * @param  array  $data
     * @return \App\Models\Dossie
     */
    public function create(array $data)
    {
        return $this->repo->create($data);
    }

    /**
     * Atualiza uma função (Dossie) existente.
     *
     * @param  int    $id
     * @param  array  $data
     * @return bool|\App\Models\Dossie
     */
    public function update($id, array $data)
    {
        return $this->repo->update($id, $data);
    }

    /**
     * Marca o ted como excluído (soft delete).
     *
     * @param  int  $id
     * @return \App\Models\Ted
     */
    public function delete($id)
    {
        return $this->repo->delete($id);
    }

    /**
     * Retorna a lista de ted com paginação.
     *
     * @param  int  $perPage
     * @return \Illuminate\Contracts\Pagination\LengthAwarePaginator
     */
    public function listPaginated($perPage = 10)
    {
        return $this->repo->paginate($perPage);
    }

}
