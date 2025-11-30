<?php

namespace App\Http\Controllers;

use App\Http\Requests\StatusSolicitacao\StatusSolicitacaoStoreRequest;
use App\Http\Requests\StatusSolicitacao\StatusSolicitacaoUpdateRequest;
use App\Services\StatusSolicitacaoService;

class StatusSolicitacaoController extends Controller
{
    /**
     * Serviço responsável pelas operações de Role (aplicacao).
     *
     * @var StatusSolicitacaoService
     */
    protected $StatusSolicitacao;

    /**
     * Injeta a dependência do aplicacao de roles.
     *
     * @param  StatusSolicitacaoService  $StatusSolicitacao
     */
    public function __construct(StatusSolicitacaoService $StatusSolicitacao)
    {
        $this->StatusSolicitacao = $StatusSolicitacao;
    }

    public function index()
    {
        return $this->StatusSolicitacao->list();
    }

    public function show(int $id)
    {
        return $this->StatusSolicitacao->get($id);
    }

    public function store(StatusSolicitacaoStoreRequest $request)
    {
        return $this->StatusSolicitacao->store($request->validated());
    }

    public function update(StatusSolicitacaoUpdateRequest $request, int $id)
    {
        return $this->StatusSolicitacao->update($id, $request->validated());
    }

    public function destroy(int $id)
    {
        return $this->StatusSolicitacao->destroy($id);
    }
}
