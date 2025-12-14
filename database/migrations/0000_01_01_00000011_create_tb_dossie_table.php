<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    public function up()
    {


        Schema::create('tb_dossie', function (Blueprint $table) {
            $table->bigInteger('sq_dossie')->primary();
            $table->bigInteger('cd_solicitacao');
            $table->smallInteger('cd_tipo_documento_dossie');
            $table->bigInteger('cd_dossie_destino');
            $table->smallInteger('cd_produto_conta')->nullable();
            $table->smallInteger('cd_especie_conta')->nullable();
            $table->smallInteger('cd_tipo_dossie')->nullable();
            $table->bigInteger('cd_status');
            $table->string('dn_cpf_cnpj', 14)->nullable();
            $table->string('ds_motivo_abertura', 200)->nullable();
            $table->smallInteger('nr_ordem_conta')->nullable();
            $table->bigInteger('nr_conta')->nullable();
            $table->string('ds_chave_negocio', 200)->nullable();

            // Foreign Keys
            $table->foreign('cd_solicitacao')->references('cd_solicitacao')->on('tb_solicitacao');
            $table->foreign('cd_dossie_destino')->references('cd_dossie_destino')->on('tb_dossie_destino');
            $table->foreign('cd_tipo_documento_dossie')->references('cd_tipo_documento_dossie')->on('tb_tipo_documento_dossie');
            $table->foreign('cd_tipo_dossie')->references('cd_tipo_dossie')->on('tb_tipo_dossie');

            $table->foreign('cd_status')->references('cd_status')->on('tb_status');

            $table->integer('nr_matricula_create')->nullable();
            $table->timestamp('dt_create')->nullable();
            $table->integer('nr_matricula_atualizacao')->nullable();
            $table->timestamp('dt_update')->nullable();

        });
    }

    public function down()
    {
        Schema::dropIfExists('tb_dossie');
    }
};
