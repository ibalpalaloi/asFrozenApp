<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Produk extends Model
{
    use HasFactory;

    protected $table = "produk";

    public function kategori(){
        return $this->belongsTo(Kategori::class);
    }

    public function sub_kategori(){
        return $this->belongsTo(Sub_kategori::class);
    }

    public function diskon(){
        return $this->hasOne(Diskon::class);
    }
}
