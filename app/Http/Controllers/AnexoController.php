<?php


namespace App\Http\Controllers;


use App\Http\Requests\Anexo\AnexoRequest;
use App\Services\AnexoService;


class AnexoController extends Controller
{
    public function __construct(private AnexoService $service){}


    public function index(){ return $this->service->list(); }
    public function show(int $id){ return $this->service->get($id); }
    public function store(AnexoRequest $r){ return $this->service->store($r->validated()); }
    public function update(AnexoRequest $r,int $id){ return $this->service->update($id,$r->validated()); }
    public function destroy(int $id){ return $this->service->destroy($id); }
}
