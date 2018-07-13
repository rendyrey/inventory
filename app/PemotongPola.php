<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class PemotongPola extends Model
{
    //
    protected $table = 'pemotong_pola';
    protected $fillable = ['nama','kontak','alamat'];
}
