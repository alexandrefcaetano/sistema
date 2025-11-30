<?php

namespace App\Http\Controllers;


use App\Http\Requests\Complemento\ComplementoRequest;
use App\Services\ComplementoService;

class ComplementoController extends Controller
{
    public function __construct(private ComplementoService $complemento){}

    public function index()
    {
        return $this->complemento->list();
    }

    public function show(int $id)
    {
        return $this->complemento->get($id);
    }

    public function store(ComplementoRequest $request)
    {
        return $this->complemento->store($request->validated());
    }

    public function update(ComplementoRequest $request, int $id)
    {
        return $this->complemento->update($id, $request->validated());
    }

    public function destroy(int $id)
    {
        return $this->complemento->destroy($id);
    }
}
