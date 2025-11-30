<?php


namespace App\Http\Controllers;

use App\Http\Requests\Aplicacao\AplicacaoStoreRequest;
use App\Http\Requests\Aplicacao\AplicacaoUpdateRequest;
use App\Services\AplicacaoService;
use Illuminate\Http\Request;


class AplicacaoController extends Controller
{
    /**
     * Serviço responsável pelas operações de Role (aplicacao).
     *
     * @var AplicacaoService
     */
    protected $aplicacao;

    /**
     * Injeta a dependência do aplicacao de roles.
     *
     * @param  AplicacaoService  $aplicacao
     */
    public function __construct(AplicacaoService $aplicacao)
    {
        $this->aplicacao = $aplicacao;
    }

    public function index(Request $request)
    {

        $perPage = $request->input('per_page', 10);

        // Obtém a lista paginada de módulos
        $aplicaceos = $this->aplicacao->listPaginated($perPage);

        // Mantém o parâmetro "per_page" nos links da paginação
        $aplicaceos->appends(['per_page' => $perPage]);

        return view('aplicacao.grid', compact('aplicaceos', 'perPage'));

        return $this->aplicacao->list();
    }

    public function show(int $id)
    {
        return $this->aplicacao->get($id);
    }

    /**
     * Exibe o formulário de criação de uma nova função/permissão.
     *
     * @return \Illuminate\View\View
     */
    public function create()
    {
        return view('aplicacao.form');
    }

    public function store(AplicacaoStoreRequest $request)
    {
        return $this->aplicacao->store($request->validated());
    }

    public function update(AplicacaoUpdateRequest $request, int $id)
    {
        return $this->aplicacao->update($id, $request->validated());
    }

    public function destroy(int $id)
    {
        return $this->aplicacao->destroy($id);
    }
}
