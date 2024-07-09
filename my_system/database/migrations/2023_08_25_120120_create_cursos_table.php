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
        Schema::create('cursos', function (Blueprint $table) {
            $table->id('id_curso');
            $table->string('designacao_curso');
            $table->string('sigla_curso');
            $table->integer('id_faculdade_in_curso');
            $table->integer('id_docente_dir_curso')->nullable();
            //$table->integer("id_centro_in_curso");
            //$table->foreign('id_centro_in_curso')->references('id_centro')->on('centro_recurso')->onDelete('cascade');
            $table->foreign('id_faculdade_in_curso')->references('id_faculdade')->on('faculdades')->onDelete('cascade');
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
        Schema::dropIfExists('cursos');
    }
};
