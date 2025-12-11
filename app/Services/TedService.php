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
            $solicitacaoData = ['cd_aplicacao'=> 1];
            // cria solicitacao pelo repository correto
            $solicitacao = $this->solicitacao->create($solicitacaoData);

            /** ---------------------------------------------------
             * 2. Criar complemento (se houver)
             * ---------------------------------------------------*/
            if (!empty($data['ds_obs']) && !empty($solicitacao)) {

                $comp = [
                    'cd_solicitacao'        => $solicitacao->cd_solicitacao,
                    'cd_status'             => $data['cd_status'],
                    'nr_matricula'          => user()->nr_matricula,
                    'ds_obs'                => $data['ds_obs'],
                    'dt_complemento'        => now(),
                ];

                $solicitacao->complementos()->create($comp);
            }

            /** ---------------------------------------------------
             * 3. Criar TED vinculado à solicitação
             * ---------------------------------------------------*/

            // SOMA TODOS OS VALORES TED
            $somatorio = 0;
            if (!empty($data['vlr_ted'])) {
                foreach ($data['vlr_ted'] as $valor) {
                    $somatorio += floatval($valor['vlr_ted']);
                }
            }

            $dadosTed = [
                'cd_solicitacao'    => $solicitacao->cd_solicitacao,
                'cd_status'         => $data['cd_status'],
                'cd_dependencia'    => $data['cd_dependencia'],
                'nr_agencia'        => $data['nr_agencia'],
                'no_unidade'        => $data['no_unidade'],
                'nr_telefone'       => $data['nr_telefone'],
                'nr_conta'          => $data['nr_conta'],
                'dt_emissao'        => $data['dt_emissao'],
                'vlr_total'         => $somatorio,
            ];

            $ted = $this->repo->create($dadosTed);

            /** ---------------------------------------------------
             * 4. Criar valores do TED
             * ---------------------------------------------------*/
            if (!empty($data['vlr_ted'])) {
                foreach ($data['vlr_ted'] as $valor) {
                    $dadosValor = [
                        'cd_ted'    => $ted->cd_ted,
                        'vlr_ted'   => $valor['vlr_ted'],
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

            // 1. Atualiza TED
            $ted->update($data['cd_status']);

            // 2. Atualiza complementos
            if (!empty($data['ds_obs']) && !empty($ted->cd_solicitacao)) {

                $comp = [
                    'cd_solicitacao'        => $ted->cd_solicitacao,
                    'cd_status'             => $data['cd_status'],
                    'nr_matricula'          => user()->nr_matricula,
                    'ds_obs'                => $data['ds_obs'],
                    'dt_complemento'        => now(),
                ];
                $this->solicitacao->create($comp);
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
    public function listPaginated($perPage = 10)
    {
        return $this->repo->paginate($perPage);
    }

}
