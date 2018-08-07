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

    public function detail_order(){
      return $this->hasMany('App\DetailOrder','id_order');
    }

    public function detail_bahan(){
      return $this->hasMany('App\DetailBahan','id_order');
    }

    public function detail_label(){
      return $this->hasMany('App\DetailLabel','id_order');
    }

    public function detail_kancing(){
      return $this->hasMany('App\DetailKancing','id_order');
    }

    public function detail_sablon(){
      return $this->hasMany('App\DetailSablon','id_order');
    }

    public function detail_bordir(){
      return $this->hasMany('App\DetailBordir','id_order');
    }

    public function detail_pola(){
      return $this->hasMany('App\DetailPola','id_order');
    }
}
