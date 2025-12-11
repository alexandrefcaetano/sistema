<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    public function up(): void {
        Schema::create('tb_valores_ted', function (Blueprint $table) {

            $table->id('cd_valor_ted')->primary();
            $table->foreignId('cd_ted')->constrained('tb_ted', 'cd_ted');
            $table->decimal('vlr_ted', 16, 2);

            $table->integer('nr_matricula_create');
            $table->timestamp('dt_create');
            $table->integer('nr_matricula_atualizacao')->nullable();
            $table->timestamp('dt_update')->nullable();
        });

    }

    public function down(): void {
        Schema::dropIfExists('tb_valores_ted');
    }
};
