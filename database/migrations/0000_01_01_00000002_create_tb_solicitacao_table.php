<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;


return new class extends Migration {
    public function up(): void
    {
        Schema::create('tb_solicitacao', function (Blueprint $table) {

            $table->integer('cd_solicitacao')->primary();
            $table->integer('nr_matricula')->nullable();
            $table->integer('nr_tipo')->nullable();
            $table->timestamp('dt_solicitacao')->nullable();
            $table->integer('nr_agencia')->nullable();
            $table->string('no_unidade', 100)->nullable();
            $table->string('nr_telefone', 30)->nullable();
            $table->string('st_solicitacao', 5)->nullable();
            $table->timestamp('dt_atualizacao')->nullable();
            $table->integer('cd_tipo_solicitacao')->nullable();
            $table->integer('cd_status_solicitacao')->nullable();

            $table->integer('cd_aplicacao')->nullable();

            $table->string('no_gerente', 120)->nullable();
            $table->integer('cd_dependencia')->nullable();
            $table->integer('cd_empresa')->nullable();
            $table->integer('nr_matricula_atualizacao')->nullable();
            $table->integer('nr_matricula_funcionario')->nullable();
            $table->integer('nr_conta')->nullable();
            $table->string('ds_chave_negocio', 200)->nullable();
        });

    }

    public function down(): void
    {
        Schema::dropIfExists('tb_solicitacao');
    }
};
