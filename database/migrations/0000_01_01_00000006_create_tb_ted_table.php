<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    public function up(): void {
        Schema::create('tb_ted', function (Blueprint $table) {

            $table->integer('cd_ted')->primary();
            $table->integer('cd_solicitacao');
            $table->integer('nr_agencia')->nullable();
            $table->integer('nr_conta')->nullable();
            $table->timestamp('dt_emissao')->nullable();

            $table->foreign('cd_solicitacao')
                ->references('cd_solicitacao')
                ->on('tb_solicitacao');
        });

    }

    public function down(): void {
        Schema::dropIfExists('tb_ted');
    }
};
