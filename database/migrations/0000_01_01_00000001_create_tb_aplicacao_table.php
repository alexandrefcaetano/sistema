<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    public function up(): void {
        Schema::create('tb_aplicacao', function (Blueprint $table) {

            $table->id('cd_aplicacao')->primary();
            $table->string('no_aplicacao', 120)->nullable();
            $table->string('no_rota',255);
            $table->string('st_aplicacao',2);

        });

    }

    public function down(): void {
        Schema::dropIfExists('tb_aplicacao');
    }
};



