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
        Schema::create('disciplinas', function (Blueprint $table) {
            $table->string('codigo_disciplina');
            $table->integer('id_curso_in_disciplina');
            $table->primary('codigo_disciplina');
            $table->string('nome_disciplina');
            $table->integer('ano');
            $table->integer('semestre');
            $table->string('sigla_disciplina');
            $table->integer('id_cat_disciplina');
            $table->string("cod_area_in_disciplina");
            $table->integer('horas_contacto');
            $table->foreign('cod_area_in_disciplina')->references('cod_area')->on('area_cientificas')->onDelete('cascade');
            $table->foreign('id_curso_in_disciplina')->references('id_curso')->on('cursos')->onDelete('cascade');
            $table->foreign('id_cat_disciplina')->references('id_cat_disciplina')->on('categorias')->onDelete('cascade');
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
        Schema::dropIfExists('disciplinas');
    }
};
