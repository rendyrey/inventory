<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Produksi extends Model
{
    //

    protected $table = 'produksi';
    protected $fillable = ['id_model','pola','warna','model','ukuran','hasil'];

    public function detail_prod_bahan(){
      return $this->hasMany('App\DetailProduksiBahan','id_detail_prod_bahan');
    }

    


}
