<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class DetailOrder extends Model
{
    //
    protected $table = 'detail_order';
    protected $fillable = ['id_order','id_produksi'];

    public function order(){
      return $this->belongsTo('App\Order','id_order');
    }

    public function produksi(){
      return $this->belongsTo('App\Produksi','id_produksi');
    }
}
