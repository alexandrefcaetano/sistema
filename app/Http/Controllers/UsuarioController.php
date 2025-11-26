<?php

namespace App\Http\Controllers;

use App\Models\Role;
use App\Models\Usuario;
use Illuminate\Http\Request;
use App\Services\UsuarioService;
use App\Http\Requests\UsuarioRequest;
use RealRashid\SweetAlert\Facades\Alert;

/**
 * Controller responsável pelo gerenciamento de usuários do sistema.
 *
 * Controla o fluxo de criação, listagem, edição, exclusão e visualização,
 * interagindo com a camada de serviço (`UsuarioService`).
 */
class UsuarioController extends Controller
{
    /**
     * Instância do serviço de usuários.
     *
     * @var \App\Services\UsuarioService
     */
    protected $service;

    /**
     * Construtor da classe.
     *
     * @param  \App\Services\UsuarioService  $service
     */
    public function __construct(UsuarioService $service)
    {
        $this->service = $service;
    }

    /**
     * Exibe a lista paginada de usuários.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\View\View
     */
    public function index(Request $request)
    {
        $perPage = $request->input('per_page', 10);
        $users = $this->service->listPaginated($perPage);
        $users->appends(['per_page' => $perPage]);

        return view('users.grid', compact('users', 'perPage'));
    }

    /**
     * Exibe o formulário para criação de um novo usuário.
     *
     * @return \Illuminate\View\View
     */
    public function create()
    {
        $roles = Role::all(); // envia todas as roles para o select
        $user = new Usuario();
        return view('users.form', compact('roles', 'user'));
    }

    /**
     * Armazena um novo usuário no banco de dados.
     *
     * @param  \App\Http\Requests\UsuarioRequest  $request
     * @return \Illuminate\Http\RedirectResponse
     */
    public function store(UsuarioRequest $request)
    {
        $this->service->create($request->validated());
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
        $user = $this->service->getById($id);
        return view('users.partial._visualizar', compact('user'))->render();
    }

    /**
     * Exibe o formulário para editar um usuário existente.
     *
     * @param  int  $id
     * @return \Illuminate\View\View
     */
    public function edit($id)
    {
        $roles = Role::all();


        $user = $this->service->getById($id);

        $user->load('roles');
        return view('users.form', compact('user','roles'));
    }

    /**
     * Atualiza os dados de um usuário existente.
     *
     * @param  \App\Http\Requests\UsuarioRequest  $request
     * @param  int  $id
     * @return \Illuminate\Http\RedirectResponse
     */
    public function update(UsuarioRequest $request, $id)
    {
        $this->service->update($id, $request->validated());
        return redirect()->route('users.index')->with('success', 'Usuário atualizado com sucesso!');
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
        $this->service->delete($id);
        return redirect()->back()->with('success', 'Usuário removido com sucesso!');
    }
}
