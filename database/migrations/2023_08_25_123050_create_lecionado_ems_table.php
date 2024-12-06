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
        Schema::create('lecionado_ems', function (Blueprint $table) {
            $table->integer('id_curso');
            $table->string('codigo_disciplina');
            $table->primary(array('id_curso', 'codigo_disciplina'));
            $table->integer('ano');
            $table->integer('semestre');
            $table->integer('horas_contacto');
            $table->timestamps();
            $table->foreign('id_curso')->references('id_curso')->on('cursos')->onDelete('cascade');
            $table->foreign('codigo_disciplina')->references('codigo_disciplina')->on('disciplinas')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('lecionado_ems');
    }
};
