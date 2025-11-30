<?php

namespace App\Services;

use App\Repository\AplicacaoRepository;


class AplicacaoService
{
    public function __construct(private AplicacaoRepository $repo) {}

    public function list(int $perPage = 15)
    {
        return $this->repo->paginate($perPage);
    }

    public function get(int $id)
    {
        return $this->repo->find($id);
    }

    public function store(array $data)
    {
        return $this->repo->create($data);
    }

    public function update(int $id, array $data)
    {
        return $this->repo->update($id, $data);
    }

    public function destroy(int $id)
    {
        return $this->repo->delete($id);
    }
    /**
     * Retorna uma lista paginada de módulos.
     *
     * @param  int  $perPage  Quantidade de registros por página (padrão: 10)
     * @return \Illuminate\Contracts\Pagination\LengthAwarePaginator
     */
    public function listPaginated($perPage = 10)
    {
        return $this->repo->paginate($perPage);
    }
}
