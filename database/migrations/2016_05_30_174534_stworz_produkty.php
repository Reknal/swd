<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class StworzProdukty extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('produkty', function (Blueprint $table) {
            $table->increments('id');
            $table->string('nazwa');
            $table->decimal('objetosc');            
            $table->decimal('masa');
            $table->decimal('wartosc');
            $table->integer('liczbaProduktow');
            $table->integer('miastoId')->unsigned();
            $table->foreign('miastoId')->references('id')->on('miasta');
            
            $table->rememberToken();
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
        Schema::drop('produkty');
    }
}
