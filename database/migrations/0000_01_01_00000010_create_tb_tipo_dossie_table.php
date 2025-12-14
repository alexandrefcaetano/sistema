<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;
use Illuminate\Support\Facades\DB;

return new class extends Migration {
    public function up()
    {
        Schema::create('tb_tipo_dossie', function (Blueprint $table) {
            $table->smallInteger('cd_tipo_dossie')->primary();
            $table->string('no_tipo_dossie', 100);
            $table->char('st_ativo', 1)->nullable();
        });

        // Adiciona CHECK após a criação da tabela
        DB::statement("
            ALTER TABLE tb_tipo_dossie
            ADD CONSTRAINT chk_tb_tipo_dossie_st_ativo
            CHECK (st_ativo IS NULL OR st_ativo IN ('A','I'));
        ");
    }

    public function down()
    {
        Schema::dropIfExists('tb_tipo_dossie');
    }
};
