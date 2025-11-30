<?php


namespace App\Services;


use App\Repository\AnexoRepository;


class AnexoService
{
    public function __construct(private AnexoRepository $repo){}


    public function list($perPage=15){ return $this->repo->paginate($perPage); }
    public function get($id){ return $this->repo->find($id); }
    public function store($d){ return $this->repo->create($d); }
    public function update($id,$d){ return $this->repo->update($id,$d); }
    public function destroy($id){ return $this->repo->delete($id); }
}
