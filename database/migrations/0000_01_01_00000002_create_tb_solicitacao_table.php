<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;


return new class extends Migration {
    public function up(): void
    {
        Schema::create('tb_solicitacao', function (Blueprint $table) {

            $table->id('cd_solicitacao')->primary();

            $table->foreignId('cd_aplicacao')
                ->constrained('tb_aplicacao', 'cd_aplicacao');
        });

    }

    public function down(): void
    {
        Schema::dropIfExists('tb_solicitacao');
    }
};
