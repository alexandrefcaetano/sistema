<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;
use Illuminate\Support\Facades\DB;

return new class extends Migration {
    public function up()
    {
        Schema::create('tb_dossie_status', function (Blueprint $table) {

            $table->bigIncrements('sq_dossie_status');
            $table->bigInteger('sq_dossie')->nullable();

            $table->char('st_contrato_unico', 1)->nullable();
            $table->char('st_ficha_qualificacao_pf', 1)->nullable();
            $table->char('st_doc_identificacao', 1)->nullable();
            $table->char('st_nao_consta', 1)->nullable();
            $table->char('st_doc_confere_original', 1)->nullable();
            $table->char('st_assinatura_conferida', 1)->nullable();
            $table->char('st_renda_presumida', 1)->nullable();
            $table->char('st_renda_automatica', 1)->nullable();
            $table->char('st_renda_anexa', 1)->nullable();
            $table->char('st_cartao_assinatura', 1)->nullable();
            $table->char('st_comprovante_renda', 1)->nullable();
            $table->char('st_cartao_cnpj', 1)->nullable();
            $table->char('st_contrato_social', 1)->nullable();
            $table->char('st_faturamento', 1)->nullable();
            $table->char('st_outro', 1)->nullable();
            $table->char('st_ficha_qualificacao_pj', 1)->nullable();
        });

        // CHECKS
        $cols = [
            'st_contrato_unico',
            'st_ficha_qualificacao_pf',
            'st_doc_identificacao',
            'st_nao_consta',
            'st_doc_confere_original',
            'st_assinatura_conferida',
            'st_renda_presumida',
            'st_renda_automatica',
            'st_renda_anexa',
            'st_cartao_assinatura',
            'st_comprovante_renda',
            'st_cartao_cnpj',
            'st_contrato_social',
            'st_faturamento',
            'st_outro',
            'st_ficha_qualificacao_pj'
        ];

        foreach ($cols as $col) {
            // nomes únicos para constraints: chk_tb_dossie_status_<col>
            $constraintName = "chk_tb_dossie_status_{$col}";
            DB::statement("
                ALTER TABLE tb_dossie_status
                ADD CONSTRAINT {$constraintName}
                CHECK ({$col} IS NULL OR {$col} IN ('S','N'));
            ");
        }

        // FK para tb_dossie.sq_dossie (criado aqui após a tabela existir)
        DB::statement("
            ALTER TABLE tb_dossie_status
            ADD CONSTRAINT fk_tb_dossie_status_sq_dossie
            FOREIGN KEY (sq_dossie)
            REFERENCES tb_dossie (sq_dossie)
            ON DELETE SET NULL;
        ");
    }

    public function down()
    {
        // remover FK com segurança se existir
        DB::statement("
            ALTER TABLE IF EXISTS tb_dossie_status
            DROP CONSTRAINT IF EXISTS fk_tb_dossie_status_sq_dossie;
        ");

        // remover CHECKs com segurança
        $cols = [
            'st_contrato_unico',
            'st_ficha_qualificacao_pf',
            'st_doc_identificacao',
            'st_nao_consta',
            'st_doc_confere_original',
            'st_assinatura_conferida',
            'st_renda_presumida',
            'st_renda_automatica',
            'st_renda_anexa',
            'st_cartao_assinatura',
            'st_comprovante_renda',
            'st_cartao_cnpj',
            'st_contrato_social',
            'st_faturamento',
            'st_outro',
            'st_ficha_qualificacao_pj'
        ];

        foreach ($cols as $col) {
            $constraintName = "chk_tb_dossie_status_{$col}";
            DB::statement("
                ALTER TABLE IF EXISTS tb_dossie_status
                DROP CONSTRAINT IF EXISTS {$constraintName};
            ");
        }

        Schema::dropIfExists('tb_dossie_status');
    }
};
