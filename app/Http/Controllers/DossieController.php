<?php

namespace App\Http\Controllers;

use App\Http\Requests\Dossie\DossieStoreRequest;
use App\Http\Requests\Ted\TedStoreRequest;
use App\Http\Requests\Ted\TedUpdateRequest;
use App\Models\Dossie;
use App\Models\DossieDestino;
use App\Models\Status;
use App\Models\TipoDocumentoDossie;
use App\Services\DossieService;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

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
        $dossie = new Dossie();
        $destinos = DossieDestino::where('st_ativo', 'A')->orderBy('ds_dossie_destino')->pluck('ds_dossie_destino', 'cd_dossie_destino');
        $tipoDocumentos = TipoDocumentoDossie::where('st_ativo', 'A')->orderBy('no_tipo_documento_dossie')->pluck('no_tipo_documento_dossie', 'cd_tipo_documento_dossie');
        $produtos = Status::whereIn('cd_status', [1, 2, 25, 26, 27, 28])->get();

        return view('dossie.form',compact( 'dossie','destinos','tipoDocumentos', 'produtos'));
    }

    /**
     * Armazena um novo Dossie no banco de dados.
     *
     * @param  \App\Http\Requests\DossieStoreRequest  $request
     * @return \Illuminate\Http\RedirectResponse
     */
    public function store(DossieStoreRequest $request)
    {
        dd($request);
        $this->dossie->create($request->validated());
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
        $user = $this->dossie->getById($id);
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
        $dossie= $this->dossie->getById($id);
//dd($dossie);
        $destinos = DossieDestino::where('st_ativo', 'A')->orderBy('ds_dossie_destino')->pluck('ds_dossie_destino', 'cd_dossie_destino');
        $tipoDocumentos = TipoDocumentoDossie::where('st_ativo', 'A')->orderBy('no_tipo_documento_dossie')->pluck('no_tipo_documento_dossie', 'cd_tipo_documento_dossie');
        $produtos = Status::whereIn('cd_status', [1, 2, 25, 26, 27, 28])->get();

        return view('dossie.form',compact( 'dossie','destinos','tipoDocumentos', 'produtos'));
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
        $this->dossie->update($id, $request->validated());
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
