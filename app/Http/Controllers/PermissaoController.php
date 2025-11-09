<?php

namespace App\Http\Controllers;

use App\Http\Requests\RoleRequest;
use App\Models\Module;
use App\Services\RoleService;
use Illuminate\Http\Request;

class PermissaoController extends Controller
{
    /**
     * Serviço responsável pelas operações de Role (permissões/funções).
     *
     * @var RoleService
     */
    protected $service;

    /**
     * Injeta a dependência do serviço de roles.
     *
     * @param  RoleService  $service
     */
    public function __construct(RoleService $service)
    {
        $this->service = $service;
    }

    /**
     * Exibe a listagem paginada de permissões (funções).
     *
     * @param  Request  $request
     * @return \Illuminate\View\View
     */
    public function index(Request $request)
    {
        $perPage = $request->input('per_page', 10); // padrão 10
        $roles = $this->service->listPaginated($perPage);

        // Mantém o parâmetro per_page nos links da paginação
        $roles->appends(['per_page' => $perPage]);

        return view('permissao.grid', compact('roles', 'perPage'));

        // (Este retorno nunca será alcançado — pode ser removido)
        $roles = $this->service->list();
        return view('permissao.grid', compact('roles'));
    }

    /**
     * Exibe o formulário de criação de uma nova função/permissão.
     *
     * @return \Illuminate\View\View
     */
    public function create()
    {
        $modules = Module::with('abilities')->get();
        $perm = null; // Nenhuma permissão selecionada inicialmente
        return view('permissao.form', compact('modules', 'perm'));
    }

    /**
     * Armazena uma nova função/permissão no banco de dados.
     *
     * @param  RoleRequest  $request
     * @return \Illuminate\Http\RedirectResponse
     */
    public function store(RoleRequest $request)
    {
        $this->service->create($request->validated());
        return redirect()->route('permissao.index')->with('success', 'Função criada com sucesso!');
    }

    /**
     * Exibe o formulário de edição de uma função/permissão existente.
     *
     * @param  int  $id
     * @return \Illuminate\View\View
     */
    public function edit($id)
    {
        $perm = $this->service->find($id);
        $modules = Module::with('abilities')->get();
        return view('permissao.form', compact('modules', 'perm'));
    }

    /**
     * Atualiza uma função/permissão existente.
     *
     * @param  RoleRequest  $request
     * @param  int  $id
     * @return \Illuminate\Http\RedirectResponse
     */
    public function update(RoleRequest $request, $id)
    {
        $this->service->update($id, $request->validated());
        return redirect()->route('permissao.index')->with('success', 'Função atualizada com sucesso!');
    }

    /**
     * Remove (soft delete) uma função/permissão.
     *
     * @param  int  $id
     * @return \Illuminate\Http\RedirectResponse
     */
    public function destroy($id)
    {
        $this->service->delete($id);
        return redirect()->route('permissao.index')->with('success', 'Função removida.');
    }

    /**
     * Restaura uma função/permissão previamente removida (soft deleted).
     *
     * @param  int  $id
     * @return \Illuminate\Http\RedirectResponse
     */
    public function restore($id)
    {
        try {
            $this->service->restore($id);
            return redirect()->route('permissao.index')->with('success', 'Função restaurada com sucesso!');
        } catch (\Exception $e) {
            return redirect()->route('permissao.index')->with('error', 'Erro ao restaurar: ' . $e->getMessage());
        }
    }

    /**
     * Exibe os detalhes completos de uma função/permissão.
     *
     * @param  int  $id
     * @return string|\Illuminate\Http\JsonResponse
     */
    public function show($id)
    {
        try {
            $permissao = $this->service->find($id);
            $permissao->load(['abilities.module']);

            return view('permissao.partial._visualizar', compact('permissao'))->render();
        } catch (\Exception $e) {
            return response()->json([
                'error' => 'Erro ao carregar permissão: ' . $e->getMessage()
            ], 500);
        }
    }
}
