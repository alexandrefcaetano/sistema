<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    public function up(): void {
        Schema::create('tb_complemento', function (Blueprint $table) {

            $table->id('cd_complemento')->primary();
            $table->foreignId('cd_status')->constrained('tb_status', 'cd_status');
            $table->foreignId('cd_solicitacao')->constrained('tb_solicitacao', 'cd_solicitacao');
            $table->integer('nr_matricula')->nullable();
            $table->string('ds_obs', 500)->nullable();
            $table->timestamp('dt_complemento')->nullable();

            $table->integer('nr_matricula_create');
            $table->timestamp('dt_create');
            $table->integer('nr_matricula_atualizacao')->nullable();
            $table->timestamp('dt_update')->nullable();



        });

    }

    public function down(): void {
        Schema::dropIfExists('tb_complemento');
    }
};
