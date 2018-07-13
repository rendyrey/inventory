<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class FkDetail extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        //
        Schema::table('detail_prod_bahan',function(Blueprint $table) {
          $table->foreign('id_bahan')->references('id')->on('bahan')->onDelete('cascade')->onUpdate('cascade');
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
        Schema::table('detail_prod_bahan',function(Blueprint $table){
          $table->dropForeign(['id_bahan']);
        });
    }
}
