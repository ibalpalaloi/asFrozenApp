<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Stok_produk extends Model
{
    use HasFactory;

    protected $table = "stok_produk";

    public function produk(){
        return $this->belongsTo(Produk::class);
    }
}
