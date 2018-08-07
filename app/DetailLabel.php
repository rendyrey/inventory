<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class DetailLabel extends Model
{
    //
    protected $table = 'detail_label';
    protected $fillabel = ['id_order','ukuran','jumlah','harga'];

    public function order(){
      return $this->belongsTo('App\Order','id_order');
    }
}
