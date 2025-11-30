<?php


namespace App\Repository;


use App\Models\Anexo;


class AnexoRepository
{
    public function __construct(private Anexo $model){}


    public function paginate($perPage){ return $this->model->paginate($perPage); }
    public function find($id){ return $this->model->findOrFail($id); }
    public function create($d){ return $this->model->create($d); }
    public function update($id,$d){ $m=$this->model->findOrFail($id); $m->update($d); return $m; }
    public function delete($id){ return $this->model->findOrFail($id)->delete(); }
}
