<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Riwayat_pesanan extends Model
{
    use HasFactory;

    protected $table = "riwayat_pesanan";

    public function riwayat_nota_pesanan(){
        return $this->belongsTo(Riwayat_nota_pesanan::class);
    }

    public function produk(){
        return $this->belongsTo(Produk::class);
    }
}
