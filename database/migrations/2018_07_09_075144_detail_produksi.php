<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class DetailProduksi extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        //
        Schema::create('detail_prod_bahan',function(Blueprint $table){
          $table->increments('id');
          $table->integer('id_detail_prod_bahan')->unsigned();
          $table->integer('id_bahan')->unsigned();
          $table->integer('keperluan');
          $table->string('satuan');
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
        //
        Schema::dropIfExists('detail_prod_bahan');
    }
}
