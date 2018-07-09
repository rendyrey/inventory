<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class Produksi extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        //
        Schema::create('produksi',function(Blueprint $table){
          $table->increments('id');
          $table->integer('id_detail_prod_bahan');
          $table->integer('id_model')->unsigned();
          $table->integer('id_pola')->unsigned();
          $table->integer('id_warna');
          $table->string('ukuran');
          $table->integer('hasil');
          $table->timestamps();
        });

        Schema::create('model',function(Blueprint $table){
          $table->increments('id');
          $table->string('nama');
          $table->timestamps();
        });

        Schema::create('pola',function(Blueprint $table){
          $table->increments('id');
          $table->string('nama');
          $table->timestamps();
        });

        Schema::table('produksi',function(Blueprint $table){
          $table->foreign('id_model')->references('id')->on('model')->onDelete('cascade');
          $table->foreign('id_pola')->references('id')->on('pola')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        //
        Schema::dropIfExists('produksi');
        Schema::dropIfExists('model');
        Schema::dropIfExists('pola');
    }
}
