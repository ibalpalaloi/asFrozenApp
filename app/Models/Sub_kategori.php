<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Sub_kategori extends Model
{
    use HasFactory;
    protected $table = "sub_kategori";

    public function kategori(){
        return $this->belongsTo(Kategori::class);
    }

    public function produk(){
        return $this->hasMany(Produk::class);
    }
}
