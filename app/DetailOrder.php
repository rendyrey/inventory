<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class DetailOrder extends Model
{
    //
    protected $table = 'detail_order';
    protected $fillable = ['id_order','id_bahan','keperluan','hasil'];
}
