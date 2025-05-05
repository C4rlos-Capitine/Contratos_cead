<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('clausula_contrato', function (Blueprint $table) {
            $table->id("id_clausula");
            $table->integer("ordem_clausula")->nullable();
            $table->string("titulo_clausula")->nullable();
            $table->string("subtitulo_clausula")->nullable();
            $table->text("descricao_clausula")->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('table_clausula_contrato');
    }
};
