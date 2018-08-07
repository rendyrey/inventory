<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class DetailSablon extends Model
{
    //
    protected $table = 'detail_sablon';
    protected $fillable = ['id_order','desain','jumlah','harga'];

    public function order(){
      return $this->belongsTo('App\Order','id_order');
    }
}
