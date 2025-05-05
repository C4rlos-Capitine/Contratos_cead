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
        Schema::create('contrato_labs', function (Blueprint $table) {
            $table->integer('id_tecnico');
            $table->string('codigo_disciplina');
            $table->integer('id_curso');
            $table->year('ano_contrato');
            $table->integer('remuneracao_hora');
            $table->string('estado');//campo que diz se o contrato: esta no cead, foi enviado para TA(enviado_ta), aprovado no ta ou reprovado no ta
            $table->date('data_chegada_no_ta');
            $table->primary(array('id_tecnico', 'ano_contrato', 'codigo_disciplina'));
            $table->foreign('id_tecnico')->references('id_tecnico')->on('tecnicos')->onDelete('cascade');
            $table->foreign('id_curso')->references('id_curso')->on('cursos')->onDelete('cascade');
            $table->foreign('codigo_disciplina')->references('codigo_disciplina')->on('disciplinas')->onDelete('cascade');
           
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
        Schema::dropIfExists('contrato_labs');
    }
};
