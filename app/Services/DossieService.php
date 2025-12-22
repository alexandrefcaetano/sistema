<?php

namespace App\Services;

use App\Models\Solicitacao;
use App\Models\TedValor;
use App\Repository\DossieRepository;
use Illuminate\Support\Facades\DB;
use App\Services\AnexoService;

class DossieService
{
    public function __construct(
        private DossieRepository $repo,
        private AnexoService $anexoService,
        private Solicitacao $solicitacao,
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
     * Cria uma nova função (Dossie) com os dados informados.
     *
     * @param  array  $data
     * @return \App\Models\Dossie
     */
    public function create(array $data)
    {

        DB::beginTransaction();

        try {
            /** ---------------------------------------------------
             * 1. Criar a Solicitação
             * ---------------------------------------------------*/
            $solicitacao = $this->solicitacao->create([
                'cd_aplicacao' => 1
            ]);

            /** ---------------------------------------------------
             * 2. Criar complemento (se houver)
             * ---------------------------------------------------*/
            if (!empty($data['ds_obs'])) {
                $solicitacao->complementos()->create([
                    'cd_solicitacao' => $solicitacao->cd_solicitacao,
                    'cd_status'      => 1,
                    'nr_matricula'   => user()->nr_matricula,
                    'ds_obs'         => $data['ds_obs'],
                    'dt_complemento' => now(),
                ]);
            }

            /** ---------------------------------------------------
             * 3. Criar DISSIE vinculado à solicitação
             * ---------------------------------------------------*/
            $dossie = $this->repo->create([
                'cd_solicitacao'    => $solicitacao->cd_solicitacao,
                'cd_status'         => 1,
                'cd_dependencia'    => $data['cd_dependencia'],
                'cd_dossie_destino' => $data['cd_dossie_destino'],
                'cd_produto_conta'  => $data['cd_produto_conta'],
                'cd_especie_conta'  => $data['cd_especie_conta'],
                'cd_tipo_documento_dossie'=> $data['cd_tipo_documento_dossie'],
                'cd_tipo_dossie'    => $data['cd_tipo_dossie'],

                'no_unidade'        => $data['no_unidade'],
                'nr_telefone'       => $data['nr_telefone'] ?? null,
                'dn_cpf_cnpj'       => $data['dn_cpf_cnpj'],
                'ds_chave_negocio'  => $data['ds_chave_negocio'] ?? null,
                'nr_conta'          => $data['nr_conta'],
                'dt_emissao'        => $data['dt_emissao'],
            ]);

            /** ---------------------------------------------------
             * 4. Processar ANEXOS
             * ---------------------------------------------------*/
            $this->anexoService->salvar(
                arquivos: $data['anexo'],
                cdSolicitacao: $solicitacao->cd_solicitacao,
                descricoes: $data['descricao_anexo'] ?? []
            );


        DB::commit();
        return $dossie;

       } catch (\Throwable $e) {
          DB::rollBack();
          throw $e;
        }
    }

    /**
     * Atualiza uma função (Dossie) existente.
     *
     * @param  int    $id
     * @param  array  $data
     * @return bool|\App\Models\Dossie
     */
    public function update($id, array $data)
    {
        return $this->repo->update($id, $data);
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
