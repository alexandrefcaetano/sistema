<?php

namespace App\Services;

use App\Repository\RoleRepository;

/**
 * Camada de serviço responsável por gerenciar as operações relacionadas às funções (roles/permissões).
 *
 * Essa classe atua como intermediária entre o controlador e o repositório,
 * centralizando regras de negócio e validações antes de acessar o banco de dados.
 */
class RoleService
{
    /**
     * Instância do repositório de roles.
     *
     * @var RoleRepository
     */
    protected $repo;

    /**
     * Construtor do serviço.
     *
     * @param  RoleRepository  $repo
     */
    public function __construct(RoleRepository $repo)
    {
        $this->repo = $repo;
    }

    /**
     * Retorna todas as funções (roles) cadastradas.
     *
     * @return \Illuminate\Support\Collection|\Illuminate\Database\Eloquent\Collection
     */
    public function list()
    {
        return $this->repo->all();
    }

    /**
     * Busca uma função (role) pelo seu identificador.
     *
     * @param  int  $id
     * @return \App\Models\Role|null
     */
    public function find($id)
    {
        return $this->repo->find($id);
    }

    /**
     * Cria uma nova função (role) com os dados informados.
     *
     * @param  array  $data
     * @return \App\Models\Role
     */
    public function create(array $data)
    {
        return $this->repo->create($data);
    }

    /**
     * Atualiza uma função (role) existente.
     *
     * @param  int    $id
     * @param  array  $data
     * @return bool|\App\Models\Role
     */
    public function update($id, array $data)
    {
        return $this->repo->update($id, $data);
    }

    /**
     * Remove (soft delete) uma função (role).
     *
     * @param  int  $id
     * @return bool|null
     */
    public function delete($id)
    {
        return $this->repo->delete($id);
    }

    /**
     * Retorna uma lista paginada de funções (roles).
     *
     * @param  int  $perPage  Quantidade de registros por página (padrão: 10)
     * @return \Illuminate\Contracts\Pagination\LengthAwarePaginator
     */
    public function listPaginated($perPage = 10)
    {
        return $this->repo->paginate($perPage);
    }

    /**
     * Restaura uma função (role) que foi removida (soft deleted).
     *
     * @param  int  $id
     * @return bool|null
     */
    public function restore($id)
    {
        return $this->repo->restore($id);
    }
}
