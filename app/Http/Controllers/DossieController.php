<?php

namespace App\Http\Controllers;

use App\Http\Requests\Ted\TedStoreRequest;
use App\Http\Requests\Ted\TedUpdateRequest;
use App\Models\Dossie;
use App\Services\DossieService;
use Illuminate\Http\Request;

class DossieController extends Controller
{

    /**
     * Instância do serviço de Dossie.
     *
     * @var \App\Services\DossieService
     */
    protected $dossie;
    /**
     * Construtor da classe.
     *
     * @param  \App\Services\DossieService  $dossie
     */
    public function __construct(DossieService $dossie) {  $this->dossie = $dossie;}

    /**
     * Exibe a lista paginada de Dossie.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\View\View
     */
    public function index(Request $request)
    {
        $perPage = $request->input('per_page', 10);
        $dossies = $this->dossie->listPaginated($perPage);
        $dossies->appends(['per_page' => $perPage]);

        return view('dossie.grid', compact('dossies', 'perPage'));
    }

    /**
     * Exibe o formulário para criação de um novo Dossie.
     *
     * @return \Illuminate\View\View
     */
    public function create()
    {
        $teds = new Ted();
        return view('dossie.form',compact( 'teds'));
    }

    /**
     * Armazena um novo Dossie no banco de dados.
     *
     * @param  \App\Http\Requests\DossieStoreRequest  $request
     * @return \Illuminate\Http\RedirectResponse
     */
    public function store(DossieStoreRequest $request)
    {
        //dd($request);
        $this->ted->create($request->validated());
        return redirect()->back()->with('success', 'Função atualizada com sucesso!');
    }

    /**
     * Exibe os detalhes de um Dossie específico.
     *
     * @param  int  $id
     * @return string
     */
    public function show($id)
    {
        $user = $this->ted->getById($id);
        return view('dossie.partial._visualizar', compact('user'))->render();
    }

    /**
     * Exibe o formulário para editar um Dossie existente.
     *
     * @param  int  $id
     * @return \Illuminate\View\View
     */
    public function edit($id)
    {
        $teds= $this->ted->getById($id);
        return view('dossie.form', compact('teds'));
    }

    /**
     * Atualiza os dados de um Dossie existente.
     *
     * @param  \App\Http\Requests\DossieUpdateRequest  $request
     * @param  int  $id
     * @return \Illuminate\Http\RedirectResponse
     */
    public function update(DossieUpdateRequest $request, $id)
    {
        $this->ted->update($id, $request->validated());
        return redirect()->route('dossie.index')->with('success', 'Dossie atualizado com sucesso!');
        //return redirect()->back()->with('success', 'Dossie atualizado com sucesso!');
    }

    /**
     * Marca um Dossie como excluído (exclusão lógica).
     *
     * @param  int  $id
     * @return \Illuminate\Http\RedirectResponse
     */
    public function destroy($id)
    {
        $this->ted->delete($id);
        return redirect()->back()->with('success', 'Dossie removido com sucesso!');
    }

}
