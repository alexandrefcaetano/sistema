<?php

namespace App\Http\Controllers;

use App\Http\Requests\Ted\TedStoreRequest;
use App\Http\Requests\Ted\TedUpdateRequest;
use App\Models\Ted;
use App\Services\TedService;
use Illuminate\Http\Request;

class TedController extends Controller
{

    /**
     * Instância do serviço de ted.
     *
     * @var \App\Services\TedService
     */
    protected $ted;
    /**
     * Construtor da classe.
     *
     * @param  \App\Services\TedService  $ted
     */
    public function __construct(TedService $ted) {  $this->ted = $ted;}

    /**
     * Exibe a lista paginada de ted.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\View\View
     */
    public function index(Request $request)
    {
        $perPage = $request->input('per_page', 10);
        $teds = $this->ted->listPaginated($perPage);
        $teds->appends(['per_page' => $perPage]);

        return view('ted.grid', compact('teds', 'perPage'));
    }

    /**
     * Exibe o formulário para criação de um novo Teds.
     *
     * @return \Illuminate\View\View
     */
    public function create()
    {
        $teds = new Ted();
        return view('ted.form',compact( 'teds'));
    }

    /**
     * Armazena um novo ted no banco de dados.
     *
     * @param  \App\Http\Requests\TedStoreRequest  $request
     * @return \Illuminate\Http\RedirectResponse
     */
    public function store(TedStoreRequest $request)
    {
        //dd($request);
        $this->ted->create($request->validated());
        return redirect()->back()->with('success', 'Função atualizada com sucesso!');
    }

    /**
     * Exibe os detalhes de um usuário específico.
     *
     * @param  int  $id
     * @return string
     */
    public function show($id)
    {
        $user = $this->ted->getById($id);
        return view('ted.partial._visualizar', compact('user'))->render();
    }

    /**
     * Exibe o formulário para editar um usuário existente.
     *
     * @param  int  $id
     * @return \Illuminate\View\View
     */
    public function edit($id)
    {
        $teds= $this->ted->getById($id);
        return view('ted.form', compact('teds'));
    }

    /**
     * Atualiza os dados de um usuário existente.
     *
     * @param  \App\Http\Requests\TedUpdateRequest  $request
     * @param  int  $id
     * @return \Illuminate\Http\RedirectResponse
     */
    public function update(TedUpdateRequest $request, $id)
    {
        $this->ted->update($id, $request->validated());
        return redirect()->route('ted.index')->with('success', 'Ted atualizado com sucesso!');
        //return redirect()->back()->with('success', 'Usuário atualizado com sucesso!');
    }

    /**
     * Marca um usuário como excluído (exclusão lógica).
     *
     * @param  int  $id
     * @return \Illuminate\Http\RedirectResponse
     */
    public function destroy($id)
    {
        $this->ted->delete($id);
        return redirect()->back()->with('success', 'Ted removido com sucesso!');
    }

}
