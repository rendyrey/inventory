<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class DetailPola extends Model
{
    //
    protected $table = 'detail_pola';
    protected $fillable = ['id_order','nama','qty_potong','qty_bahan','jml_dikirim','ukuran'];

    public function order(){
      return $this->belongsTo('App\Order','id_order');
    }
}
