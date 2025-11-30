<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    public function up(): void {
        Schema::create('tb_valor_ted', function (Blueprint $table) {

            $table->integer('cd_valor_ted')->primary();
            $table->integer('cd_ted');
            $table->decimal('vl_ted', 16, 2)->nullable();

            $table->foreign('cd_ted')
                ->references('cd_ted')
                ->on('tb_ted');
        });

    }

    public function down(): void {
        Schema::dropIfExists('tb_valor_ted');
    }
};
