<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    public function up(): void {
        Schema::create('tb_aplicacao', function (Blueprint $table) {

            $table->integer('cd_aplicacao')->primary();
            $table->string('no_aplicacao', 120)->nullable();
            $table->integer('no_tipo')->nullable();
            $table->integer('cd_tipo_aplicacao')->nullable();
            $table->string('ds_email_gestor', 120)->nullable();
            $table->string('no_apelido_email_gestor', 120)->nullable();
            $table->string('no_gestor', 120)->nullable();
            $table->string('nr_telefone_gestor', 40)->nullable();
            $table->string('st_aplicacao', 5)->nullable();
        });

    }

    public function down(): void {
        Schema::dropIfExists('tb_aplicacao');
    }
};



