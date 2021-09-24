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
use App\Models\Produk;
use App\Models\Kategori;

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

    public function get_detail_produk($id){
        $data_produk = Produk::find($id);
        $sub_kategori = Sub_kategori::where('id', $data_produk->sub_kategori->id)->get();
        $prodduk = array();
        $produk['id'] = $data_produk->id;
        $produk['nama'] = $data_produk->nama;
        $produk['harga'] = $data_produk->harga;
        $produk['satuan'] = $data_produk->satuan;
        $produk['deskripsi'] = $data_produk->deskripsi;
        $produk['kategori'] = $data_produk->kategori->kategori;
        $produk['sub_kategori'] = $data_produk->sub_kategori->sub_kategori;
        $produk['foto'] = $data_produk->foto;
        return response()->json(['produk'=>$produk, 'sub_kategori' => $sub_kategori]);
    }

    public function get_kategori(){
        $kategori = Kategori::all();
        return response()->json(['kategori' => $kategori]);
    }

    public function get_embed_video(Request $request){
        $link = $request->link;
        $ytarray=explode("/", $link);
        $ytendstring=end($ytarray);
        $ytendarray=explode("?v=", $ytendstring);
        $ytendstring=end($ytendarray);
        $ytendarray=explode("&", $ytendstring);
        $ytcode=$ytendarray[0];

        return response()->json(['link_embed'=>$ytcode]);
    }
}
