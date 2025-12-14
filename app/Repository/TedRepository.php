<?php

namespace App\Repository;

use App\Models\Ted;

class TedRepository
{
    protected $model;

    public function __construct(Ted $model)
    {
        $this->model = $model;
    }

    /**
     * Aplica os filtros de TED na query
     */
    public function applyFiltrosTed(Builder $query, array $filters): Builder
    {
        if (!empty($filters['cd_solicitacao'])) {
            $query->where('cd_solicitacao', $filters['cd_solicitacao']);
        }

        if (!empty($filters['cd_dependencia'])) {
            $query->where('cd_dependencia', $filters['cd_dependencia']);
        }

        if (!empty($filters['nr_conta'])) {
            $query->where('nr_conta', $filters['nr_conta']);
        }

        if (!empty($filters['cd_status'])) {
            $query->where('cd_status', $filters['cd_status']);
        }

        if (!empty($filters['dt_emissao'])) {
            try {
                $data = Carbon::createFromFormat('d/m/Y', $filters['dt_emissao'])
                    ->format('Y-m-d');

                $query->whereDate('dt_emissao', $data);
            } catch (\Exception $e) {
                // ignora data inválida
            }
        }

        // -------------------------------------------------
        // FILTRO POR VALOR TOTAL
        // -------------------------------------------------

        $vlrInicio = $filters['vlr_inicio'] ?? null;
        $vlrFim    = $filters['vlr_fim'] ?? null;

        if ($vlrInicio) {
            $vlrInicio = normalizeMoney($vlrInicio);
        }

        if ($vlrFim) {
            $vlrFim = normalizeMoney($vlrFim);
        }

        if ($vlrInicio && $vlrFim) {
            $query->whereBetween('vlr_total', [$vlrInicio, $vlrFim]);
        } elseif ($vlrInicio) {
            $query->where('vlr_total', '>=', $vlrInicio);
        } elseif ($vlrFim) {
            $query->where('vlr_total', '<=', $vlrFim);
        }

        return $query;
    }

    public function paginate(int $perPage = 15, array $filters = [])
    {
        $query = $this->model->with('status');

        $this->applyFiltrosTed($query, $filters);

        return $query->paginate($perPage);
    }


    public function getQuery()
    {
        return $this->model->newQuery();
    }

    public function find(int $id)
    {
        return $this->model->with(['solicitacao','status','valores'])->findOrFail($id);
    }

    public function create(array $data)
    {
        return $this->model->create($data);
    }

    public function update(int $id, array $data)
    {
        $m = $this->model->findOrFail($id);
        $m->update($data);
        return $m;
    }

    public function delete(int $id)
    {
        $m = $this->model->findOrFail($id);
        return $m->delete();
    }

    public function getAll()
    {
        return $this->model->all();
    }
}
