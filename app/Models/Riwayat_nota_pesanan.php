<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Riwayat_nota_pesanan extends Model
{
    use HasFactory;

    protected $table = "riwayat_nota_pesanan";

    public function riwayat_pesanan(){
        return $this->hasMany(Riwayat_pesanan::class);
    }

    public function user(){
        return $this->belongsTo(User::class);
    }
}
