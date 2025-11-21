<?php

namespace App\Services;

use App\Repository\UsuarioRepository;
use Illuminate\Support\Facades\Hash;

/**
 * Camada de serviço responsável pelas regras de negócio
 * relacionadas aos usuários do sistema.
 */
class UsuarioService
{
    /**
     * Instância do repositório de usuários.
     *
     * @var \App\Repository\UsuarioRepository
     */
    protected $repository;

    /**
     * Construtor da classe.
     *
     * @param  \App\Repository\UsuarioRepository  $repository
     */
    public function __construct(UsuarioRepository $repository)
    {
        $this->repository = $repository;
    }

    /**
     * Retorna todos os usuários (sem paginação).
     *
     * @return \Illuminate\Support\Collection
     */
    public function listAll()
    {
        return $this->repository->getAll();
    }

    /**
     * Retorna um usuário pelo ID.
     *
     * @param  int  $id
     * @return \App\Models\Usuario
     */
    public function getById($id)
    {
        return $this->repository->find($id);
    }

    /**
     * Cria um novo usuário.
     *
     * @param  array  $data
     * @return \App\Models\Usuario
     */
    public function create(array $data)
    {
        return $this->repository->create($data);
    }

    /**
     * Atualiza um usuário existente.
     *
     * @param  int    $id
     * @param  array  $data
     * @return \App\Models\Usuario
     */
    public function update($id, array $data)
    {
        if (isset($data['password'])) {
            $data['password'] = Hash::make($data['password']);
        }

        return $this->repository->update($id, $data);
    }

    /**
     * Marca o usuário como excluído (soft delete).
     *
     * @param  int  $id
     * @return \App\Models\Usuario
     */
    public function delete($id)
    {
        return $this->repository->delete($id);
    }

    /**
     * Retorna a lista de usuários com paginação.
     *
     * @param  int  $perPage
     * @return \Illuminate\Contracts\Pagination\LengthAwarePaginator
     */
    public function listPaginated($perPage = 10)
    {
        return $this->repository->paginate($perPage);
    }


    public function autenticar($cpf, $password)
    {
        $usuario = $this->repository->findByCPF($cpf);

        if (!$usuario) {
            return false;
        }

        if (!Hash::check($password, $usuario->password)) {
            return false;
        }

//        if ($usuario->status !== 'AT') {
//            return false;
//        }

        return $usuario;
    }
}
