<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class DetailBahan extends Model
{
    //
    protected $table = 'detail_bahan';
    protected $fillable = ['id_order','id_bahan','jumlah','harga'];

    public function order(){
      return $this->belongsTo('App\Order','id_order');
    }

    public function bahan(){
      return $this->belongsTo('App\Bahan','id_bahan');
    }
}
