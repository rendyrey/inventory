<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class DetailKancing extends Model
{
    //
    protected $table = 'detail_kancing';
    protected $fillable = ['id_order','ukuran','tipe','jumlah','harga','warna'];

    public function order(){
      return $this->belongsTo('App\Order','id_order');
    }
}
