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
        Schema::create('lecionas', function (Blueprint $table) {
            $table->integer('id_docente_in_leciona');
            $table->integer('id_curso_in_leciona');
            $table->string('codigo_disciplina_in_leciona');
            $table->year('ano_contrato');
            $table->integer('id_tipo_contrato_in_leciona');
            $table->foreign('id_tipo_contrato_in_leciona')->references('id_tipo_contrato')->on('tipo_contratos')->onDelete('cascade');
            $table->primary(array('id_docente_in_leciona', 'id_curso_in_leciona', 'codigo_disciplina_in_leciona', 'ano_contrato'));
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
        Schema::dropIfExists('lecionas');
    }
};
