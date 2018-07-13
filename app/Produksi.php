<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Produksi extends Model
{
    //
    
    protected $table = 'produksi';
    protected $fillable = ['id_detail_prod_bahan','id_model','id_pola','id_warna','ukuran','hasil'];
}
