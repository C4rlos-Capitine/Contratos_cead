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
        Schema::create('tecnicos', function (Blueprint $table) {
            $table->id('id_tecnico');
            $table->string('nome_tecnico');
            $table->string('apelido_tecnico');
            $table->string('nacionalidade');
            $table->string('bi');
            $table->string('nuit');
            $table->integer('id_nivel');
            $table->integer('id_faculdade_in_tecnico');
            $table->string('genero');
            $table->integer('id_curso');
            $table->foreign('id_curso')->references('id_curso')->on('cursos')->onDelete('cascade');
            $table->string('email')->unique();
            $table->foreign('id_nivel')->references('id_nivel')->on('nivels')->onDelete('cascade');
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
        Schema::dropIfExists('tecnicos');
    }
};
