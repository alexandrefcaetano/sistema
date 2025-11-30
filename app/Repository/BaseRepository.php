<?php

namespace App\Repository;


use Illuminate\Database\Eloquent\Model;


class BaseRepository
{
    public function __construct(protected Model $model) {}


    public function paginate($perPage = 15)
    {
        return $this->model->paginate($perPage);
    }


    public function find($id)
    {
        return $this->model->findOrFail($id);
    }


    public function create(array $data)
    {
        return $this->model->create($data);
    }


    public function update($id, array $data)
    {
        $m = $this->model->findOrFail($id);
        $m->update($data);
        return $m;
    }


    public function delete($id)
    {
        $m = $this->model->findOrFail($id);
        return $m->delete();
    }
}
