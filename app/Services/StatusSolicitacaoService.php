<?php

namespace App\Services;

use App\Repository\StatussolicitacaoRepository;


class StatusSolicitacaoService
{
    public function __construct(private StatusSolicitacaoRepository $repo) {}

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
}
