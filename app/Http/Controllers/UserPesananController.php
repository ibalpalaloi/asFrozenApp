<?php

namespace App\Http\Controllers;

use App\Models\Pesanan;
use App\Models\Nota;
use App\Models\Keranjang;
use Illuminate\Http\Request;

class UserPesananController extends Controller
{
    //

    public function pesanan(){
        $notas = Nota::where('user_id', Auth()->user()->id)->get();
        return view('user.payment.pesanan', compact('notas'));
    }

    public function batalkan_pesanan($id){
        $pesanan = Pesanan::where('nota_id', $id)->get();
        $id_user = Auth()->user()->id;
        foreach($pesanan as $data){
            $keranjang = new Keranjang;
            $keranjang->user_id = $id_user;
            $keranjang->produk_id = $data->produk_id;
            $keranjang->jumlah = $data->jumlah;
            $keranjang->checked = "true";
            $keranjang->save();
        }
        Pesanan::where('nota_id', $id)->delete();
        Nota::find($id)->delete();
        return redirect('/keranjang');
    }

    public function biodata(){
        return view('user/biodata/index');
    }
}
