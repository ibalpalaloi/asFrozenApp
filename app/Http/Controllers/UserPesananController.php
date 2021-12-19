<?php

namespace App\Http\Controllers;

use App\Models\Pesanan;
use App\Models\Nota;
use App\Models\Kota;
use App\Models\Kecamatan;
use App\Models\Kelurahan;
use App\Models\Biodata;
use App\Models\Keranjang;
use App\Models\Produk;
use App\Models\Riwayat_pesanan;
use App\Models\Stok_produk;
use App\Models\Riwayat_nota_pesanan;
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

            $this->ubah_stok($data->produk_id, $data->jumlah);
        }
        Pesanan::where('nota_id', $id)->delete();
        Nota::find($id)->delete();
        return redirect('/keranjang');
    }

    public function ubah_stok($produk_id, $jumlah){
        $stok = Stok_produk::where('produk_id', $produk_id)->first();
        if(!empty($stok)){
            $stok->stok = $stok->stok + $jumlah;
            $stok->save();
        }
    }

    public function update_biodata(Request $request){
        $db = Biodata::where('id', Auth()->user()->biodata->id)->first();
        $db->nama = $request->nama;
        $db->no_telp = $request->no_telp;
        $db->jenis_kelamin = $request->jenis_kelamin;
        $db->alamat = $request->alamat;
        $db->kelurahan_id = $request->kelurahan;
        $db->save();

        if ($request->from == 'keranjang'){
            return redirect('/keranjang/checkout');
        }
        return redirect()->back();

    }

    public function biodata(){
        $agent = new Agent();
        $kota = Kota::all();
        $user = Biodata::where('id', Auth()->user()->biodata->id)->first();   
        $kecamatan = "";
        $kelurahan = "";
        if ($user->kelurahan_id){
            $kota_id = Auth()->user()->biodata->kelurahan->kecamatan->kota->id;
            $kecamatan_id = Auth()->user()->biodata->kelurahan->kecamatan->id;
            $kecamatan = Kecamatan::where('kota_id', $kota_id)->get();
            $kelurahan = kelurahan::where('kecamatan_id', $kecamatan_id)->get();
        }        
        if ($agent->isMobile()){
            return view('user/biodata/mobile', compact('user', 'kota', 'kecamatan', 'kelurahan'));
        }
        else {
            return view('user/biodata/desktop', compact('user', 'kota','kecamatan', 'kelurahan'));            
        }
    }

    public function riwayat_pesanan(){
        $riwayat_nota = Riwayat_nota_pesanan::where('user_id', Auth()->user()->id)->get();
        // dd($riwayat_nota);
        return view('user.riwayat.riwayat_pesanan', compact('riwayat_nota'));
    }

    public function riwayat_pesanan_detail($id){
        $riwayat_nota = Riwayat_nota_pesanan::where('id_pesanan', $id)->first();
        $riwayat = Riwayat_pesanan::where('riwayat_nota_pesanan_id', $riwayat_nota->id)->get();
        // dd($riwayat);    
        $qrcode = new Generator;
        return view('user.riwayat.riwayat_pesanan_detail', compact('riwayat_nota', 'riwayat', 'qrcode'));

    }
}

