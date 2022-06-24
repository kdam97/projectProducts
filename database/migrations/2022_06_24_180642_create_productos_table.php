<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateProductosTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('productos', function (Blueprint $table) {

            $table->bigIncrements('id')->comment('Identificador del producto');
            $table->string("nombre",255)->comment('Nombre del producto');
            $table->double("precio",255)->comment('Precio del producto');
            $table->integer("cantidad")->comment('Cantidad disponible');
            $table->unsignedBigInteger("id_categoria")->comment('Categoria del producto');
            $table->timestamps();

            $table->foreign('id_categoria')->references('id')->on('categorias');            
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('productos');
    }
}
