<?php

namespace App\Repository;

use App\Models\Ted;

class DossieRepository
{
    protected $model;

    public function __construct(Dossie $model)
    {
        $this->model = $model;
    }

    public function paginate(int $perPage = 15)
    {
        return $this->model->paginate($perPage);
    }

    public function find(int $id)
    {
        return $this->model->with([
            'valores',
            'solicitacao',
            'solicitacao.complementos',
            'solicitacao.status'
        ])->findOrFail($id);
    }

    public function create(array $data)
    {
        return $this->model->create($data);
    }

    public function update(int $id, array $data)
    {
        $m = $this->model->findOrFail($id);
        $m->update($data);
        return $m;
    }

    public function delete(int $id)
    {
        $m = $this->model->findOrFail($id);
        return $m->delete();
    }
    /**
     * Retorna todos os Ted.
     *
     * @return \Illuminate\Database\Eloquent\Collection
     */
    public function getAll()
    {
        return $this->model->all();
    }
}
