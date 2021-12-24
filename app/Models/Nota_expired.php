<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Nota_expired extends Model
{
    use HasFactory;

    protected $table = "nota_expired";

    public function user(){
        return $this->belongsTo(User::class);
    }
}
