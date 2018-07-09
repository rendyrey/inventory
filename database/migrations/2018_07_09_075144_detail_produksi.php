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
          $table->integer('id_detail_prod_bahan');
          $table->integer('id_material')->unsigned();
          $table->integer('keperluan');
          $table->string('satuan');
          $table->timestamps();
        });
        Schema::table('detail_prod_bahan',function(Blueprint $table) {
          $table->foreign('id_material')->references('id')->on('material')->onDelete('cascade')->onUpdate('cascade');
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
