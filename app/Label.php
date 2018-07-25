<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Label extends Model
{
    //
    protected $table = 'label';
    protected $fillable = ['persediaan','ukuran_huruf','ukuran_angka'];
}
