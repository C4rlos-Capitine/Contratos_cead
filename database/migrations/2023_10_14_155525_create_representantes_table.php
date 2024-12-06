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
        Schema::create('representantes', function (Blueprint $table) {
            $table->id('id_representante');
            $table->string('nome_representante');
            $table->string('apelido_representante');
            $table->string('genero_representante');
            $table->integer('id_nivel_contrantante');
            $table->foreign('id_nivel_contrantante')->references('id_nivel')->on('id_nivel_contrantante')->onDelete('cascade');
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
        Schema::dropIfExists('representantes');
    }
};
