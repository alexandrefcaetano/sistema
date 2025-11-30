<?php

namespace App\Services;


use App\Repository\BaseRepository;


class BaseService
{
    public function __construct(protected BaseRepository $repo) {}


    public function list($perPage = 15)
    {
        return $this->repo->paginate($perPage);
    }


    public function get($id)
    {
        return $this->repo->find($id);
    }


    public function store(array $data)
    {
        return $this->repo->create($data);
    }


    public function update($id, array $data)
    {
        return $this->repo->update($id, $data);
    }


    public function destroy($id)
    {
        return $this->repo->delete($id);
    }
}
