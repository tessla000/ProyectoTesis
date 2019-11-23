<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateProductoTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('producto', function (Blueprint $table) {
            $table->increments('producto_id');
            $table->string('name',25);
            $table->integer('valor')->unsigned();
            $table->integer('stock')->unsigned();
            $table->string('descripcion');
            $table->integer('categoria_id')->length(10)->unsigned()->index()->nullable();
            $table->integer('marca_id')->length(10)->unsigned()->index()->nullable();
            $table->string('image')->nullable();
            $table->timestamps();
            $table->softDeletes();
        });

        Schema::table('producto', function (Blueprint $table){
            $table->foreign('categoria_id')->references('categoria_id')->on('categoria')->onUpdate('cascade');
            $table->foreign('marca_id')->references('marca_id')->on('marca')->onUpdate('cascade');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('producto');
    }
}
