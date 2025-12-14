<?php



use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;
use Illuminate\Support\Facades\DB;

return new class extends Migration {
    public function up()
    {
        Schema::create('tb_dossie_destino', function (Blueprint $table) {
            $table->bigInteger('cd_dossie_destino')->primary();
            $table->string('ds_dossie_destino', 250);
            $table->char('st_ativo', 1)->nullable();
        });

        // Adiciona CHECK manualmente (para bancos que suportam)
        DB::statement("
            ALTER TABLE tb_dossie_destino
            ADD CONSTRAINT chk_tb_dossie_destino_st_ativo
            CHECK (st_ativo IS NULL OR st_ativo IN ('A','I'));
        ");
    }

    public function down()
    {
        Schema::dropIfExists('tb_dossie_destino');
    }
};
