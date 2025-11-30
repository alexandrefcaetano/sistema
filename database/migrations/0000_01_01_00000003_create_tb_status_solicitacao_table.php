<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    public function up(): void {
        Schema::create('tb_status_solicitacao', function (Blueprint $table) {

            $table->integer('cd_status_solicitacao')->primary();
            $table->string('no_status_solicitacao', 150)->nullable();
            $table->string('ds_status_solicitacao', 200)->nullable();
        });

    }

    public function down(): void {
        Schema::dropIfExists('tb_status_solicitacao');
    }
};
