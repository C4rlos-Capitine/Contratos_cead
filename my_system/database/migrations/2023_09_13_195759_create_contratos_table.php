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
        Schema::create('contratos', function (Blueprint $table) {
            $table->integer('id_docente_in_contrato');
            $table->integer('id_tipo_contrato_in_contrato');
            $table->year('ano_contrato');
            $table->integer('carga_horaria');
            $table->integer('remuneracao');
            $table->primary(array('id_docente_in_contrato', 'ano_contrato', 'id_tipo_contrato_in_contrato'));
            $table->foreign('id_docente_in_contrato')->references('id_docente')->on('docentes')->onDelete('cascade');
            $table->foreign('id_tipo_contrato_in_contrato')->references('id_tipo_contrato')->on('contratos')->onDelete('cascade');
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
        Schema::dropIfExists('contratos');
    }
};
