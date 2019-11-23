<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateDireccionTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('direccion', function (Blueprint $table) {
            $table->increments('direccion_id');
            $table->string('rut', 12);
            $table->string('name', 50);
            $table->string('lastname', 50);
            $table->string('codigoPostal', 7);
            $table->string('direccion1', 100);
            $table->string('descripcion', 250)->nullable();
            $table->integer('comuna_id')->length(10)->unsigned()->index()->nullable();
            $table->integer('usuario_id')->lenght(10)->unsigned()->index()->nullable();
            $table->timestamps();
            $table->softDeletes();
        });

        Schema::table('direccion', function (Blueprint $table){
            $table->foreign('comuna_id')->references('comuna_id')->on('comuna')->onUpdate('cascade');
            $table->foreign('usuario_id')->references('usuario_id')->on('users')->onUpdate('cascade');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('direccion');
    }
}
