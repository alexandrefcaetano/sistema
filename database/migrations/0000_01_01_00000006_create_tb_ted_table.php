<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    public function up(): void {
        Schema::create('tb_ted', function (Blueprint $table) {

            $table->id('cd_ted')->primary();
            $table->foreignId('cd_status')->constrained('tb_status', 'cd_status');
            $table->foreignId('cd_solicitacao')->constrained('tb_solicitacao', 'cd_solicitacao');

            $table->integer('cd_dependencia');
            $table->string('no_unidade', 255)->nullable();
            $table->integer('nr_conta')->nullable();
            $table->integer('nr_agencia')->nullable();
            $table->string('nr_telefone', 30)->nullable();
            $table->timestamp('dt_emissao')->nullable();
            $table->integer('nr_matricula_create')->nullable();
            $table->timestamp('dt_create')->nullable();
            $table->integer('nr_matricula_atualizacao')->nullable();
            $table->timestamp('dt_update')->nullable();
            $table->float('vlr_total')->nullable();

        });

    }

    public function down(): void {
        Schema::dropIfExists('tb_ted');
    }
};
