<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateOrdenTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('orden', function (Blueprint $table) {
            $table->increments('orden_id');
            $table->integer('producto_id')->lenght(10)->unsigned()->index()->nullable();
            $table->integer('quantity');
            $table->integer('price');
            $table->integer('total');
            $table->integer('transaccion_id')->lenght(10)->unsigned()->index()->nullable();
            $table->timestamps();
            $table->softDeletes();
        });

        Schema::table('orden', function (Blueprint $table){
            $table->foreign('producto_id')->references('producto_id')->on('producto')->onUpdate('cascade');
        });

        Schema::table('orden', function (Blueprint $table){
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
        Schema::dropIfExists('orden');
    }
}
