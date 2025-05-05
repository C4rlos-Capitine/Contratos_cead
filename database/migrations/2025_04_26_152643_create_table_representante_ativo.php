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
        Schema::create('table_representante_ativo', function (Blueprint $table) {
            $table->id('id_representante_ativo');
            $table->unsignedBigInteger('id_representante')->nullable();
            $table->foreign('id_representante')->references('id')->on('representantes')->onDelete('cascade');
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
        Schema::dropIfExists('table_representante_ativo');
    }
};
