<?php

namespace App\Http\Controllers;


use App\Http\Requests\Solicitacao\SolicitacaoStoreRequest;
use App\Http\Requests\Solicitacao\SolicitacaoUpdateRequest;
use App\Services\SolicitacaoService;

class SolicitacaoController extends Controller
{
    public function __construct(private SolicitacaoService $service){}

    public function index()
    {
        return $this->service->list();
    }

    public function show(int $id)
    {
        return $this->service->get($id);
    }

    public function store(SolicitacaoStoreRequest $request)
    {
        return $this->service->store($request->validated());
    }

    public function update(SolicitacaoUpdateRequest $request, int $id)
    {
        return $this->service->update($id, $request->validated());
    }

    public function destroy(int $id)
    {
        return $this->service->destroy($id);
    }
}
