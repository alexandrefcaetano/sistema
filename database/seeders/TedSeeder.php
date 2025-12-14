<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class TedSeeder extends Seeder
{
    public function run(): void
    {
        $statusPermitidos = [1, 2, 25, 26, 27, 28];

        $dependencias = [
            4,5,6,7,9,10,11,13,14,15,16,18,20,22,23,24,25,26,27,28,
            30,31,32,36,37,40,41,43,44,46,47,50,53,54,56,57,58,59,
            60,61,62,63,64,66,67,69,71,72
        ];

        $matriculas = range(677100, 677120);

        foreach ($matriculas as $matricula) {

            DB::transaction(function () use (
                $statusPermitidos,
                $dependencias,
                $matricula
            ) {

                /** ---------------------------------------------------
                 * 1. SOLICITAÇÃO
                 * ---------------------------------------------------*/
                $cdSolicitacao = DB::table('tb_solicitacao')->insertGetId([
                    'cd_aplicacao' => 3,
                ], 'cd_solicitacao');

                /** ---------------------------------------------------
                 * 2. COMPLEMENTO
                 * ---------------------------------------------------*/
                DB::table('tb_complemento')->insert([
                    'cd_solicitacao'       => $cdSolicitacao,
                    'cd_status'            => collect($statusPermitidos)->random(),
                    'nr_matricula'         => $matricula,
                    'ds_obs'               => 'Complemento gerado via Seeder',
                    'dt_complemento'       => now(),

                    'nr_matricula_create'  => $matricula,
                    'dt_create'            => now(),
                ]);

                /** ---------------------------------------------------
                 * 3. TED
                 * ---------------------------------------------------*/
                $qtdeValores = rand(2, 5); // 🔥 MAIS DE UM VALOR POR TED

                $valoresGerados = [];
                for ($i = 0; $i < $qtdeValores; $i++) {
                    $valoresGerados[] = round(mt_rand(1000, 500000) / 100, 2);
                }

                $cdTed = DB::table('tb_ted')->insertGetId([
                    'cd_solicitacao'       => $cdSolicitacao,
                    'cd_status'            => collect($statusPermitidos)->random(),
                    'cd_dependencia'       => collect($dependencias)->random(),
                    'no_unidade'           => 'UNIDADE ' . rand(1, 50),
                    'nr_conta'             => rand(100000, 999999),
                    'nr_agencia'           => rand(1000, 9999),
                    'nr_telefone'          => '1199' . rand(1000000, 9999999),
                    'dt_emissao'           => now(),
                    'vlr_total'            => array_sum($valoresGerados),

                    'nr_matricula_create'  => $matricula,
                    'dt_create'            => now(),
                ], 'cd_ted');

                /** ---------------------------------------------------
                 * 4. VALORES DO TED (MULTIPLOS)
                 * ---------------------------------------------------*/
                foreach ($valoresGerados as $valor) {
                    DB::table('tb_valores_ted')->insert([
                        'cd_ted'                  => $cdTed,
                        'vlr_ted'                 => $valor,

                        'nr_matricula_create'     => $matricula,
                        'dt_create'               => now(),
                    ]);
                }
            });
        }
    }
}
