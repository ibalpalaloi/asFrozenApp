<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class User_lupa_password extends Model
{
    use HasFactory;

    protected $table = "user_lupa_password";

    public function user(){
        return $this->belongsTo(User::class);
    }
}
