<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class DetailProduksiBahan extends Model
{
    //
    protected $table = 'detail_prod_bahan';
    protected $fillable = ['id_detail_prod_bahan','id_bahan','keperluan','satuan'];

    public function produksi(){
      return $this->belongsTo('App\Produksi','id_detail_prod_bahan');
    }

    public function bahan(){
      return $this->belongsTo('App\Bahan','id_bahan');
    }
}
