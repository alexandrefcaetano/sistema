<?php

namespace App\Http\Controllers;

use App\Http\Requests\ModuleRequest;
use App\Services\ModuleService;
use Illuminate\Http\Request;

/**
 * Controller responsável por gerenciar as operações de CRUD dos Módulos.
 *
 * Atua como camada intermediária entre as rotas e o serviço, lidando com
 * requisições HTTP, validação e retorno das views correspondentes.
 */
class ModuleController extends Controller
{
    /**
     * Serviço de módulos.
     *
     * @var ModuleService
     */
    protected ModuleService $service;

    /**
     * Injeta a dependência do serviço de módulos.
     *
     * @param  ModuleService  $service
     */
    public function __construct(ModuleService $service)
    {

        $this->service = $service;
    }

    /**
     * Exibe a listagem paginada de módulos.
     *
     * @param  Request  $request
     * @return \Illuminate\View\View
     */
    public function index(Request $request)
    {

//        dd(Auth::user()->abilities()->map(function ($ab) {
//            return $ab->module->name . '.' . $ab->name;
//        }));
        // Quantidade de itens por página (valor padrão: 10)
        $perPage = $request->input('per_page', 10);

        // Obtém a lista paginada de módulos
        $modules = $this->service->listPaginated($perPage);

        // Mantém o parâmetro "per_page" nos links da paginação
        $modules->appends(['per_page' => $perPage]);

        return view('module.grid', compact('modules', 'perPage'));
    }

    /**
     * Exibe o formulário de criação de um novo módulo.
     *
     * @return \Illuminate\View\View
     */
    public function create()
    {
        return view('module.form');
    }

    /**
     * Persiste um novo módulo no banco de dados.
     *
     * @param  ModuleRequest  $request
     * @return \Illuminate\Http\RedirectResponse
     */
    public function store(ModuleRequest $request)
    {
        $this->service->store($request->validated());

        return redirect()
            ->route('module.index')
            ->with('success', 'Módulo criado com sucesso!');
    }

    /**
     * Exibe o formulário de edição de um módulo existente.
     *
     * @param  int  $id
     * @return \Illuminate\View\View
     *
     * @throws \Illuminate\Database\Eloquent\ModelNotFoundException
     */
    public function edit($id)
    {
        $module = $this->service->find($id);

        return view('module.form', compact('module'));
    }

    /**
     * Atualiza os dados de um módulo existente.
     *
     * @param  ModuleRequest  $request
     * @param  int            $id
     * @return \Illuminate\Http\RedirectResponse
     *
     * @throws \Illuminate\Database\Eloquent\ModelNotFoundException
     */
    public function update(ModuleRequest $request, $id)
    {
        $this->service->update($id, $request->validated());

        return redirect()
            ->route('module.index')
            ->with('success', 'Módulo atualizado com sucesso!');
    }

    /**
     * Realiza a exclusão lógica de um módulo.
     *
     * @param  int  $id
     * @return \Illuminate\Http\RedirectResponse
     *
     * @throws \Illuminate\Database\Eloquent\ModelNotFoundException
     */
    public function destroy($id)
    {
        $this->service->destroy($id);

        return redirect()
            ->route('module.index')
            ->with('success', 'Módulo removido com sucesso!');
    }

    /**
     * Exibe os detalhes de um módulo em uma view parcial (visualização).
     *
     * @param  int  $id
     * @return string  Renderização HTML da partial de visualização
     *
     * @throws \Illuminate\Database\Eloquent\ModelNotFoundException
     */
    public function show($id)
    {
        $module = $this->service->find($id);

        return view('module.partial._visualizar', compact('module'))->render();
    }
}
