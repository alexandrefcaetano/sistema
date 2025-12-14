<?php

namespace App\Services;

use App\Models\Solicitacao;
use App\Models\TedValor;
use App\Repository\TedRepository;
use Illuminate\Support\Facades\DB;

class TedService
{
    public function __construct(
        private TedRepository $repo,
        private Solicitacao $solicitacao,
        private TedValor $valorTed
    ) {}


    /**
     * Retorna todos os teds (sem paginação).
     *
     * @return \Illuminate\Support\Collection
     */
    public function listAll()
    {
        return $this->repo->getAll();
    }

    /**
     * Retorna um ted pelo ID.
     *
     * @param  int  $id
     * @return \App\Models\Ted
     */
    public function getById($id)
    {
        return $this->repo->find($id);
    }

    /**
     * Cria um novo ted.
     *
     * @param  array  $data
     * @return \App\Models\Ted
     */
    public function create(array $data)
    {

        return DB::transaction(function () use ($data) {

            /** ---------------------------------------------------
             * 1. Criar a Solicitação
             * ---------------------------------------------------*/
            $solicitacaoData = ['cd_aplicacao'=> 3];
            // cria solicitacao pelo repository correto
            $solicitacao = $this->solicitacao->create($solicitacaoData);

            /** ---------------------------------------------------
             * 2. Criar complemento (se houver)
             * ---------------------------------------------------*/
            if (!empty($data['ds_obs']) && !empty($solicitacao)) {

                $comp = [
                    'cd_solicitacao'        => $solicitacao->cd_solicitacao,
                    'cd_status'             => 1,
                    'nr_matricula'          => user()->nr_matricula,
                    'ds_obs'                => $data['ds_obs'],
                    'dt_complemento'        => now(),
                ];

                $solicitacao->complementos()->create($comp);
            }

            /** ---------------------------------------------------
             * 3. Criar TED vinculado à solicitação
             * ---------------------------------------------------*/


            $dadosTed = [
                'cd_solicitacao'    => $solicitacao->cd_solicitacao,
                'cd_status'         => 1,
                'cd_dependencia'    => $data['cd_dependencia'],
                'nr_agencia'        => $data['nr_agencia'],
                'no_unidade'        => $data['no_unidade'],
                'nr_telefone'       => $data['nr_telefone'],
                'nr_conta'          => $data['nr_conta'],
                'dt_emissao'        => $data['dt_emissao'],
                'vlr_total'         => normalizeMoney($data['vlr_total']),
            ];

            $ted = $this->repo->create($dadosTed);

            /** ---------------------------------------------------
             * 4. Criar valores do TED
             * ---------------------------------------------------*/
            if (!empty($data['vlr_ted'])) {
                foreach ($data['vlr_ted'] as $valor) {
                    $dadosValor = [
                        'cd_ted'    => $ted->cd_ted,
                        'vlr_ted'   => normalizeMoney($valor['vlr']),
                    ];
                    $this->valorTed->create($dadosValor);
                }
            }

            return $solicitacao->cd_solicitacao;
        });
    }



    /**
     * Atualiza um ted existente.
     *
     * @param  int    $id
     * @param  array  $data
     * @return \App\Models\Ted
     */
    public function update($id, array $data)
    {
        return DB::transaction(function () use ($id, $data) {

            $ted = $this->repo->find($id);

            /** ---------------------------------------------------
             * 1. Atualizar TED
             * ---------------------------------------------------*/
            $dadosTed = [
                'cd_status'      => $data['cd_status'],
                'cd_dependencia' => $data['cd_dependencia'],
                'nr_agencia'     => $data['nr_agencia'],
                'no_unidade'     => $data['no_unidade'],
                'nr_telefone'    => $data['nr_telefone'],
                'nr_conta'       => $data['nr_conta'],
                'dt_emissao'     => $data['dt_emissao'],
                'vlr_total'      => normalizeMoney($data['vlr_total']),
            ];

            $ted = $this->repo->update($id, $dadosTed);

            /** ---------------------------------------------------
             * 2. Criar complemento (se houver)
             * ---------------------------------------------------*/
            if (!empty($data['ds_obs'])) {

                $ted->solicitacao->complementos()->create([
                    'cd_status'    => $data['cd_status'],
                    'nr_matricula' => user()->nr_matricula,
                    'ds_obs'       => $data['ds_obs'],
                    'dt_complemento' => now(),
                ]);
            }

            /** ---------------------------------------------------
             * 3. Atualizar valores do TED (CORRETO)
             * ---------------------------------------------------*/
            // 🔴 remove valores antigos
            $ted->valores()->delete();

            // 🟢 cria valores novos
            if (!empty($data['vlr_ted'])) {
                foreach ($data['vlr_ted'] as $valor) {

                    if (empty($valor['vlr'])) {
                        continue;
                    }

                    $ted->valores()->create([
                        'vlr_ted' => normalizeMoney($valor['vlr']),
                    ]);
                }
            }

            return $ted;
        });
    }



    /**
     * Marca o ted como excluído (soft delete).
     *
     * @param  int  $id
     * @return \App\Models\Ted
     */
    public function delete($id)
    {
        return $this->repo->delete($id);
    }

    /**
     * Retorna a lista de ted com paginação.
     *
     * @param  int  $perPage
     * @return \Illuminate\Contracts\Pagination\LengthAwarePaginator
     */
    public function listPaginated(int $perPage = 10, array $filters = [])
    {
        return $this->repo->paginate($perPage, $filters);
    }

}
