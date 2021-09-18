<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Ongkos_kirim extends Model
{
    use HasFactory;

    protected $table = "ongkos_kirim";

    public function kelurahan(){
        return $this->belongsTo(Kelurahan::class);
    }
}
