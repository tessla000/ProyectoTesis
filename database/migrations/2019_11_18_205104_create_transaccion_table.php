<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateTransaccionTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('transaccion', function (Blueprint $table) {
            $table->increments('transaccion_id');
            $table->integer('amount');
            $table->string('buyOrder');
            $table->string('commerceCode');
            $table->string('authorizationCode');
            $table->string('resultado');
            $table->integer('producto_id')->lenght(10)->unsigned()->index()->nullable();
            $table->integer('quantity');
            $table->integer('usuario_id')->lenght(10)->unsigned()->index()->nullable();
            $table->timestamps();
            $table->softDeletes();
        });

        Schema::table('transaccion', function (Blueprint $table){
            $table->foreign('usuario_id')->references('usuario_id')->on('users')->onDelete('cascade')->onUpdate('cascade');
        });

        Schema::table('transaccion', function (Blueprint $table){
            $table->foreign('producto_id')->references('producto_id')->on('producto')->onDelete('cascade')->onUpdate('cascade');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('transaccion');
    }
}
