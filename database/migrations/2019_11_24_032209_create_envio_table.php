<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateEnvioTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('envio', function (Blueprint $table) {
            $table->increments('envio_id');
            $table->string('codigoSeguimiento');
            $table->integer('estado')->lenght(2)->unsigned();
            $table->integer('direccion_id')->lenght(10)->unsigned()->index()->nullable();
            $table->integer('transaccion_id')->lenght(10)->unsigned()->index()->nullable();
            $table->timestamps();
            $table->softDeletes();
        });

        Schema::table('envio', function (Blueprint $table){
            $table->foreign('direccion_id')->references('direccion_id')->on('direccion')->onUpdate('cascade');
        });

        Schema::table('envio', function (Blueprint $table){
            $table->foreign('transaccion_id')->references('transaccion_id')->on('transaccion')->onUpdate('cascade');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('envio');
    }
}
