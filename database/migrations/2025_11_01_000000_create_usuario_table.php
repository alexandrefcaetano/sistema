<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('usuario', function (Blueprint $table) {
            $table->id();
            $table->string('no_usuario', 120);
            $table->integer('nr_matricula', 120);
            $table->string('nr_agencia', 120);
            $table->string('password');
            $table->string('status', 2)->default('AT');
            $table->string('cpf', 20)->nullable();
            $table->date('data_nascimento')->nullable();
            $table->string('sexo', 2)->nullable();
            $table->json('contato')->nullable();
            $table->boolean('excluido')->default(false);
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('usuario');
    }
};
