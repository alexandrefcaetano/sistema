<?php
use App\Repository\TedRepository;

class RelatorioTeds
{
    public function __construct(
        protected TedRepository $repository
    ) {}

    protected function dadosTeds(array $filters): array
    {
        $query = $this->repository->getQuery()
            ->select([
                'tb_aplicacao.no_aplicacao',
                'tb_solicitacao.cd_solicitacao',
                'tb_ted.cd_dependencia',
                'tb_ted.no_unidade',
                'tb_ted.nr_conta',
                'tb_ted.nr_agencia',
                'tb_ted.nr_telefone',
                'tb_ted.dt_emissao',
                'tb_ted.vlr_total',
                'tb_ted.nr_matricula_create',
                'tb_ted.dt_create',
                'tb_ted.nr_matricula_atualizacao',
                'tb_ted.dt_update',
            ])
            ->join('tb_solicitacao', 'tb_solicitacao.cd_solicitacao', '=', 'tb_ted.cd_solicitacao')
            ->join('tb_aplicacao', 'tb_aplicacao.cd_aplicacao', '=', 'tb_solicitacao.cd_aplicacao')
            ->where('tb_aplicacao.cd_aplicacao', 3);

        // 🔑 AQUI ESTÁ O REAPROVEITAMENTO
        $this->repository->applyFiltrosTed($query, $filters);

        return $query
            ->orderByDesc('tb_solicitacao.cd_solicitacao')
            ->get()
            ->toArray();
    }
}
