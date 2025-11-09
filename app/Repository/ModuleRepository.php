<?php

namespace App\Repository;

use App\Models\Module;
use Illuminate\Support\Facades\DB;

/**
 * Repositório responsável por realizar o acesso direto ao banco de dados
 * para a entidade Module e suas relações com abilities.
 *
 * Esta camada concentra todas as consultas e persistências de dados
 * referentes à tabela `modules`.
 */
class ModuleRepository
{
    /**
     * Retorna todos os módulos com suas abilities relacionadas.
     *
     * @return \Illuminate\Database\Eloquent\Collection
     */
    public function getAll()
    {
        return Module::with('abilities')->get();
    }

    /**
     * Busca um módulo específico pelo ID, incluindo suas abilities.
     *
     * @param  int  $id
     * @return \App\Models\Module
     *
     * @throws \Illuminate\Database\Eloquent\ModelNotFoundException
     */
    public function find($id)
    {
        return Module::with('abilities')->findOrFail($id);
    }

    /**
     * Cria um novo módulo e suas abilities associadas em uma transação.
     *
     * @param  array  $data
     * @return \App\Models\Module
     *
     * @throws \Throwable
     */
    public function create(array $data)
    {
        return DB::transaction(function () use ($data) {
            $module = Module::create([
                'name'         => $data['name'],
                'display_name' => $data['display_name'],
            ]);

            foreach ($data['abilities'] as $ability) {
                $module->abilities()->create($ability);
            }

            return $module;
        });
    }

    /**
     * Atualiza um módulo existente e suas abilities associadas.
     *
     * As abilities antigas são removidas e recriadas de acordo com os novos dados.
     *
     * @param  int    $id
     * @param  array  $data
     * @return \App\Models\Module
     *
     * @throws \Throwable
     */
    public function update($id, array $data)
    {
        return DB::transaction(function () use ($id, $data) {
            $module = Module::findOrFail($id);

            $module->update([
                'name'         => $data['name'],
                'display_name' => $data['display_name'],
            ]);

            // Remove as abilities antigas e recria
            $module->abilities()->delete();

            foreach ($data['abilities'] as $ability) {
                $module->abilities()->create($ability);
            }

            return $module;
        });
    }

    /**
     * Marca um módulo como excluído (exclusão lógica).
     *
     * @param  int  $id
     * @return bool
     *
     * @throws \Illuminate\Database\Eloquent\ModelNotFoundException
     */
    public function delete($id)
    {
        $module = Module::findOrFail($id);

        $module->excluido = true;
        return $module->save();
    }

    /**
     * Retorna módulos com paginação, ordenados do mais recente para o mais antigo.
     *
     * @param  int  $perPage  Número de itens por página
     * @return \Illuminate\Contracts\Pagination\LengthAwarePaginator
     */
    public function paginate($perPage = 10)
    {
        return Module::orderBy('id', 'desc')->paginate($perPage);
    }
}
