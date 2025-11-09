<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    public function up(): void {
        Schema::create('modules', function (Blueprint $table) {
            $table->id();
            $table->string('name', 120)->unique();          // ex: "usuarios", "permissoes"
            $table->string('display_name', 120);            // ex: "Usuários", "Permissões"
            $table->string('description', 255)->nullable();
            $table->string('status',2);
            $table->boolean('excluido')->default(false);
            $table->timestamps();
        });
    }

    public function down(): void {
        Schema::dropIfExists('modules');
    }
};
