<?php

namespace App\Http\Controllers;

use App\Models\Pesanan;
use App\Models\Nota;
use Illuminate\Http\Request;

class UserPesananController extends Controller
{
    //

    public function pesanan(){
        $notas = Nota::where('user_id', Auth()->user()->id)->get();
        return view('user.pesanan', compact('notas'));
    }
}
