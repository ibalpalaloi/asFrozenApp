<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Sub_kategori;
use App\Models\Kota;
use App\Models\Kecamatan;
use App\Models\Kelurahan;
use App\Models\Ongkos_kirim;
use App\Models\Riwayat_nota_pesanan;
use App\Models\Riwayat_pesanan;

class GetController extends Controller
{
    //
    public function get_sub_kategori($id){
        $sub_kategori = Sub_kategori::where('kategori_id', $id)->get();
        return response()->json(['sub_kategori' => $sub_kategori]);
    }

    public function get_kecamatan($id){
        $kecamatan = Kecamatan::where('kota_id', $id)->get();
        return response()->json(['kecamatan'=>$kecamatan]);
    }

    public function get_kelurahan($id){
        $kelurahan = Kelurahan::where('kecamatan_id', $id)->get();
        return response()->json(['kelurahan'=>$kelurahan]);
    }

    public function get_ongkir($id){
        $ongkir = Ongkos_kirim::where('kelurahan_id', $id)->first();
        $ongkos_kirim = $ongkir->ongkos_kirim;
        return response()->json(['ongkos_kirim'=>$ongkos_kirim]);
    }

    public function get_riwayat_pesanan($id){
        $pesanan = Riwayat_pesanan::where('riwayat_nota_pesanan_id', $id)->get();
        $nota = Riwayat_nota_pesanan::find($id);
        return response()->json(['pesanan'=>$pesanan, 'nota'=>$nota]);
    }
}
