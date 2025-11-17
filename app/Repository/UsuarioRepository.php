<?php

namespace App\Repository;

use App\Models\Usuario;
use Illuminate\Support\Facades\Hash;

/**
 * Repositório responsável por gerenciar o acesso
 * aos dados dos usuários no banco.
 */
class UsuarioRepository
{
    /**
     * Instância do model Usuario.
     *
     * @var \App\Models\Usuario
     */
    protected $model;

    /**
     * Construtor da classe.
     *
     * @param  \App\Models\Usuario  $model
     */
    public function __construct(Usuario $model)
    {
        $this->model = $model;
    }

    /**
     * Retorna todos os usuários.
     *
     * @return \Illuminate\Database\Eloquent\Collection
     */
    public function getAll()
    {
        return $this->model->all();
    }

    /**
     * Retorna usuários paginados.
     *
     * @param  int  $perPage
     * @return \Illuminate\Contracts\Pagination\LengthAwarePaginator
     */
    public function paginate($perPage = 10)
    {
        return $this->model->orderBy('id', 'desc')->paginate($perPage);
    }

    /**
     * Busca um usuário específico pelo ID.
     *
     * @param  int  $id
     * @return \App\Models\Usuario
     */
    public function find($id)
    {
        return $this->model->findOrFail($id);
    }

    /**
     * Cria um novo usuário com senha padrão.
     *
     * @param  array  $data
     * @return \App\Models\Usuario
     */
    public function create(array $data)
    {
        $data['password'] = Usuario::SENHA_PADRAO;
        return $this->model->create($data);
    }

    /**
     * Atualiza os dados de um usuário existente.
     *
     * @param  int    $id
     * @param  array  $data
     * @return \App\Models\Usuario
     */
    public function update($id, array $data)
    {
        $user = $this->model->findOrFail($id);

        if (!empty($data['redefinir_senha'])) {
            $user->password = Usuario::SENHA_PADRAO;
        } elseif (!empty($data['password']) && $data['password'] !== '********') {
            $user->password = Hash::make($data['password']);
        }

        unset($data['password'], $data['redefinir_senha']);
        $user->update($data);

        return $user;
    }

    /**
     * Marca um usuário como excluído logicamente.
     *
     * @param  int  $id
     * @return \App\Models\Usuario
     */
    public function delete($id)
    {
        $user = $this->model->findOrFail($id);
        $user->excluido = true;
        $user->save();

        return $user;
    }

    public function findByCPF($cpf)
    {
        return Usuario::where('cpf', $cpf)->first();
    }
}
