<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    public function up(): void {
        Schema::create('tb_anexo', function (Blueprint $table) {

            $table->integer('cd_anexo')->primary();
            $table->integer('cd_arquivo')->nullable();
            $table->integer('cd_solicitacao')->nullable();
            $table->integer('cd_sub_solicitacao')->nullable();
            $table->string('ds_arquivo', 120)->nullable();
            $table->string('ds_observacoes', 300)->nullable();
            $table->string('no_arquivo', 200)->nullable();
            $table->integer('nr_tamanho_arquivo')->nullable();
            $table->string('st_aprovacao', 5)->nullable();
            $table->timestamp('dt_arquivo')->nullable();
            $table->timestamp('dt_insercao')->nullable();
            $table->integer('nr_matricula')->nullable();
            $table->timestamp('dt_exclusao')->nullable();
            $table->integer('nr_matricula_exclusao')->nullable();

            $table->foreign('cd_solicitacao')
                ->references('cd_solicitacao')
                ->on('tb_solicitacao');
        });

    }

    public function down(): void {
        Schema::dropIfExists('tb_anexo');
    }
};
