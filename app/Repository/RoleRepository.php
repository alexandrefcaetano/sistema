<?php

namespace App\Repository;

use App\Models\Role;

/**
 * Repositório responsável pelo acesso e manipulação dos dados de papéis (roles).
 *
 * Essa camada lida diretamente com o modelo Eloquent e centraliza
 * as operações de CRUD e consultas relacionadas à entidade Role.
 */
class RoleRepository
{
    /**
     * Instância do modelo Role.
     *
     * @var Role
     */
    protected $model;

    /**
     * Construtor do repositório.
     *
     * @param  Role  $model
     */
    public function __construct(Role $model)
    {
        $this->model = $model;
    }

    /**
     * Retorna todos os papéis com suas respectivas abilities.
     *
     * @return \Illuminate\Database\Eloquent\Collection
     */
    public function all()
    {
        return $this->model->with('abilities')->get();
    }

    /**
     * Retorna um papel específico pelo ID, incluindo suas abilities.
     *
     * @param  int  $id
     * @return \App\Models\Role
     *
     * @throws \Illuminate\Database\Eloquent\ModelNotFoundException
     */
    public function find($id)
    {
        return $this->model->with('abilities')->findOrFail($id);
    }

    /**
     * Cria um novo papel (role) e associa suas abilities.
     *
     * @param  array  $data
     * @return \App\Models\Role
     */
    public function create(array $data)
    {
        $role = $this->model->create([
            'name'        => $data['name'],
            'status'      => $data['status'],
            'description' => $data['description'],
        ]);

        // Vincula as abilities selecionadas
        if (!empty($data['abilities'])) {
            $role->abilities()->sync($data['abilities']);
        }

        return $role;
    }

    /**
     * Atualiza um papel existente e sincroniza suas abilities.
     *
     * @param  int    $id
     * @param  array  $data
     * @return \App\Models\Role
     *
     * @throws \Illuminate\Database\Eloquent\ModelNotFoundException
     */
    public function update($id, array $data)
    {
        $role = $this->model->findOrFail($id);

        $role->update([
            'name'        => $data['name'],
            'status'      => $data['status'],
            'description' => $data['description'],
        ]);

        // Atualiza as abilities vinculadas
        $role->abilities()->sync($data['abilities'] ?? []);

        return $role;
    }

    /**
     * Realiza a exclusão lógica (soft delete) de um papel.
     *
     * @param  int  $id
     * @return \App\Models\Role
     *
     * @throws \Illuminate\Database\Eloquent\ModelNotFoundException
     */
    public function delete($id)
    {
        $role = $this->model->findOrFail($id);

        // Atualiza o flag de exclusão lógica
        $role->excluido = true;
        $role->save();

        return $role;
    }

    /**
     * Retorna a lista de papéis (roles) com paginação.
     *
     * @param  int  $perPage  Quantidade de registros por página (padrão: 10)
     * @return \Illuminate\Contracts\Pagination\LengthAwarePaginator
     */
    public function paginate($perPage = 10)
    {
        return $this->model->orderBy('id', 'desc')->paginate($perPage);
    }

    /**
     * Restaura um papel que foi marcado como excluído (soft deleted).
     *
     * @param  int  $id
     * @return \App\Models\Role
     */
    public function restore($id)
    {
        $role = $this->find($id);
        $role->restoreFromDeleted();
        return $role;
    }
}
