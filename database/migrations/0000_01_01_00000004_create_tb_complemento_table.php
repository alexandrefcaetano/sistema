<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    public function up(): void {
        Schema::create('tb_complemento', function (Blueprint $table) {

            $table->integer('cd_complemento')->primary();
            $table->integer('cd_solicitacao');
            $table->string('ds_obs', 500)->nullable();
            $table->timestamp('dt_complemento')->nullable();
            $table->string('st_complemento', 10)->nullable();
            $table->integer('nr_matricula')->nullable();
            $table->integer('cd_status_solicitacao')->nullable();
            $table->integer('cd_tipo_complemento')->nullable();

            $table->foreign('cd_solicitacao')->references('cd_solicitacao')->on('tb_solicitacao');
            $table->foreign('cd_status_solicitacao')->references('cd_status_solicitacao')->on('tb_status_solicitacao');
        });

    }

    public function down(): void {
        Schema::dropIfExists('tb_complemento');
    }
};
