<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Bahan extends Model
{
    //
    protected $table = 'bahan';
    protected $fillable = ['nama','persediaan'];
}
