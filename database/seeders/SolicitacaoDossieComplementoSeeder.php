<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Carbon;
use Throwable;

class SolicitacaoDossieComplementoSeeder extends Seeder
{
    public function run(): void
    {

        DB::beginTransaction();

        try {



        $now = Carbon::now();

        // valores fixos conforme informado
        $cdAplicacao = 1;

        $usuarios = [
            677100, 677101, 677102, 677103, 677104, 677105, 677106, 677107,
            677108, 677109, 677110, 677111, 677112, 677113, 677114, 677115,
            677116, 677117, 677118, 677119, 677120, 677138
        ];

        $statusList = DB::table('tb_status')
            ->pluck('cd_status')
            ->toArray();
        $tipoDocumentoList = range(1, 18);
        $tipoDossieList = range(1, 7);
        $destinos = [1, 2];

        // cria 50 solicitações
        for ($i = 1; $i <= 50; $i++) {

            /**
             * SOLICITACAO
             */
            $cdSolicitacao = DB::table('tb_solicitacao')->insertGetId(
                ['cd_aplicacao' => $cdAplicacao],
                'cd_solicitacao'
            );

            /**
             * COMPLEMENTOS (1 a 3 por solicitacao)
             */
            $qtdComplementos = rand(1, 3);

            for ($c = 1; $c <= $qtdComplementos; $c++) {
                DB::table('tb_complemento')->insert([
                    'cd_status'                => $statusList[array_rand($statusList)],
                    'cd_solicitacao'           => $cdSolicitacao,
                    'nr_matricula'             => $usuarios[array_rand($usuarios)],
                    'ds_obs'                   => 'Complemento ' . $c . ' da solicitação ' . $cdSolicitacao,
                    'dt_complemento'           => $now,
                    'nr_matricula_create'      => $usuarios[array_rand($usuarios)],
                    'dt_create'                => $now,
                    'nr_matricula_atualizacao' => null,
                    'dt_update'                => null,
                ]);
            }

            /**
             * DOSSIE (1 a 2 por solicitacao)
             */
            $qtdDossies = rand(1, 2);

            for ($d = 1; $d <= $qtdDossies; $d++) {
                DB::table('tb_dossie')->insert([
                    'sq_dossie'                => DB::raw("nextval('tb_dossie_sq_dossie_seq')"),
                    'cd_solicitacao'           => $cdSolicitacao,
                    'cd_tipo_documento_dossie' => $tipoDocumentoList[array_rand($tipoDocumentoList)],
                    'cd_dossie_destino'        => $destinos[array_rand($destinos)],
                    'cd_produto_conta'         => rand(1, 5),
                    'cd_especie_conta'         => rand(1, 5),
                    'cd_tipo_dossie'           => $tipoDossieList[array_rand($tipoDossieList)],
                    'dn_cpf_cnpj'              => rand(0, 1)
                        ? str_pad(rand(1, 99999999999), 11, '0', STR_PAD_LEFT)
                        : str_pad(rand(1, 99999999999999), 14, '0', STR_PAD_LEFT),
                    'ds_motivo_abertura'       => 'Abertura automática de dossiê',
                    'nr_ordem_conta'           => rand(1, 5),
                    'nr_conta'                 => rand(1000000, 9999999),
                    'ds_chave_negocio'         => 'CHAVE-' . $cdSolicitacao . '-' . $d,
                    'cd_status'                => $statusList[array_rand($statusList)],
                    'nr_matricula_create'      => $usuarios[array_rand($usuarios)],
                    'dt_create'                => $now,
                    'nr_matricula_update'      => null,
                    'dt_update'                => null,
                ]);
            }
        }

            DB::commit();

        } catch (Throwable $e) {
            DB::rollBack();

            // MUITO IMPORTANTE: relançar a exceção
            throw $e;
        }
    }
}

/*
Como usar:
1) Salve em database/seeders/SolicitacaoDossieComplementoSeeder.php
2) Garanta que a sequence tb_dossie_sq_dossie_seq exista
3) Execute:
   php artisan db:seed --class=SolicitacaoDossieComplementoSeeder
*/
