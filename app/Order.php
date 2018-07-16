<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Order extends Model
{
    //
    protected $table = 'order';
    protected $fillable = ['nomor_order','pemberi_order','id_pemotong_pola','id_gudang_penerima','tanggal_order','tanggal_selesai','biaya_produksi'];

    public function pemotong_pola(){
      return $this->belongsTo('App\PemotongPola','id_pemotong_pola');
    }

    public function gudang(){
      return $this->belongsTo('App\Gudang','id_gudang_penerima');
    }
}
