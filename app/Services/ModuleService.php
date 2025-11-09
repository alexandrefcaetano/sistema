<?php

namespace App\Services;

use App\Repository\ModuleRepository;

/**
 * Camada de serviço responsável por gerenciar as operações de Módulos.
 *
 * Essa classe centraliza a lógica de negócio e serve como intermediária entre
 * os controladores e o repositório de módulos, garantindo uma separação clara
 * das responsabilidades.
 */
class ModuleService
{
    /**
     * Instância do repositório de módulos.
     *
     * @var ModuleRepository
     */
    protected ModuleRepository $repository;

    /**
     * Construtor da classe ModuleService.
     *
     * @param  ModuleRepository  $repository
     */
    public function __construct(ModuleRepository $repository)
    {
        $this->repository = $repository;
    }

    /**
     * Retorna todos os módulos com suas respectivas abilities.
     *
     * @return \Illuminate\Database\Eloquent\Collection
     */
    public function list()
    {
        return $this->repository->getAll();
    }

    /**
     * Busca um módulo específico pelo ID.
     *
     * @param  int  $id
     * @return \App\Models\Module
     *
     * @throws \Illuminate\Database\Eloquent\ModelNotFoundException
     */
    public function find($id)
    {
        return $this->repository->find($id);
    }

    /**
     * Cria um novo módulo e suas abilities associadas.
     *
     * @param  array  $data
     * @return \App\Models\Module
     */
    public function store(array $data)
    {
        return $this->repository->create($data);
    }

    /**
     * Atualiza um módulo existente e suas abilities.
     *
     * @param  int    $id
     * @param  array  $data
     * @return \App\Models\Module
     */
    public function update($id, array $data)
    {
        return $this->repository->update($id, $data);
    }

    /**
     * Marca um módulo como excluído (exclusão lógica).
     *
     * @param  int  $id
     * @return bool
     */
    public function destroy($id)
    {
        return $this->repository->delete($id);
    }

    /**
     * Retorna uma lista paginada de módulos.
     *
     * @param  int  $perPage  Quantidade de registros por página (padrão: 10)
     * @return \Illuminate\Contracts\Pagination\LengthAwarePaginator
     */
    public function listPaginated($perPage = 10)
    {
        return $this->repository->paginate($perPage);
    }
}
