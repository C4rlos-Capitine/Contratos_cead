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
        Schema::create('docentes', function (Blueprint $table) {
            $table->id('id_docente');
            $table->string('nome_docente');
            $table->string('apelido_docente');
            $table->string('nacionalidade');
            $table->string('bi');
            $table->string('nuit');
            $table->integer('id_nivel');
            $table->string('genero');
            $table->integer('id_faculdade_in_docente');
            $table->integer('id_user')->nullable();
            $table->string('email')->unique();
            $table->string('assinado_docente')->default("Não");
            $table->string('assinado_up')->default("Não");
            $table->timestamp('email_verified_at')->nullable();
            $table->foreign('id_nivel')->references('id_nivel')->on('nivels')->onDelete('cascade');
            $table->foreign('id_user')->references('id')->on('users')->onDelete('cascade');
            $table->foreign('id_faculdade_in_docente')->references('id_faculdade')->on('faculdades')->onDelete('cascade');
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
        Schema::dropIfExists('docentes');
    }
};
