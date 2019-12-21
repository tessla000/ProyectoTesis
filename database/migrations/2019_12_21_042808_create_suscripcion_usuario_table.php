<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateSuscripcionUsuarioTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('suscripcion_usuario', function (Blueprint $table) {
            $table->increments('suscripcion_usuario_id');
            $table->integer('suscripcion_id')->lenght(10)->unsigned()->index();
            $table->integer('usuario_id')->lenght(10)->unsigned()->index();
            $table->timestamps('fecha_inicio');
            $table->timestamps('fecha_termino');
            $table->softDeletes();
            $table->timestamps();
        });

        Schema::table('suscripcion_usuario', function (Blueprint $table){
            $table->foreign('suscripcion_id')->references('suscripcion_id')->on('suscripcion')->onUpdate('cascade');
        });

        Schema::table('suscripcion_usuario', function (Blueprint $table){
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
        Schema::dropIfExists('suscripcion_usuario');
    }
}
