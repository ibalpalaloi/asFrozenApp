<?php

namespace App\Http\Controllers;

use App\Models\Pesanan;
use App\Models\Nota;
use App\Models\Keranjang;
use Illuminate\Http\Request;
use Jenssegers\Agent\Agent;
use SimpleSoftwareIO\QrCode\Facades\QrCode;
use SimpleSoftwareIO\QrCode\Generator;

class UserPesananController extends Controller
{
    //

    public function pesanan(){
        $notas = Nota::where('user_id', Auth()->user()->id)->get();
        $agent = new Agent();
        $qrcode = new Generator;
        // $qr = $qrcode->size(250)->generate($response['data']['code']);

        if ($agent->isMobile()){
            return view('user.payment.pesanan.mobile', compact('notas'));
        }
        else {
            return view('user.payment.pesanan.desktop', compact('notas', 'qrcode'));
        }
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
        $agent = new Agent();
        if ($agent->isMobile()){
            return view('user/biodata/mobile');
        }
        else {
            return view('user/biodata/desktop');            
        }
    }
}
