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
        Schema::create('curso_centro_recurso', function (Blueprint $table) {
            $table->integer("id_centro");
            $table->integer("id_curso");
            $table->primary(array("id_centro", "id_curso"));
            $table->foreign('id_centro')->references('id_centro')->on('centro_recursos')->onDelete('cascade');
            $table->foreign('id_curso')->references('id_curso')->on('cursos')->onDelete('cascade');
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
        Schema::dropIfExists('curso_centro_recurso');
    }
};
