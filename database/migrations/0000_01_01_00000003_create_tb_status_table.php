<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    public function up(): void {
        Schema::create('tb_status', function (Blueprint $table) {

            $table->id('cd_status')->primary();
            $table->string('no_status', 200);
            $table->string('ds_status', 255)->nullable();
        });

    }

    public function down(): void {
        Schema::dropIfExists('tb_status');
    }
};
