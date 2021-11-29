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
use App\Models\Nota;
use App\Models\Keranjang;

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
        $sub_kategori = "";
        if($data_produk->sub_kategori != null){
            $sub_kategori = Sub_kategori::where('id', $data_produk->sub_kategori->id)->get();
        }
        
        $prodduk = array();
        $produk['id'] = $data_produk->id;
        $produk['nama'] = $data_produk->nama;
        $produk['harga'] = number_format($data_produk->harga, 0, ",", ",");
        $produk['satuan'] = $data_produk->satuan;
        $produk['deskripsi'] = $data_produk->deskripsi;
        $produk['kategori'] = $data_produk->kategori->kategori;
        $produk['sub_kategori'] = "-";
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

    public function get_jumlah_pesanan(){
        $jumlah = array();
        $jumlah['menunggu_konfirmasi'] = Nota::where('status', 'menunggu konfirmasi')->count();
        $jumlah['packaging'] = Nota::where('status', 'packaging')->count();
        $jumlah['dalam_pengantaran'] = Nota::where('status', 'dalam pengantaran')->count();

        return response()->json(['jumlah'=>$jumlah]);
    }

    public function get_jumlah_keranjang(){
        $user = Auth()->user();
        $jumlah_keranjamng = 0;
        if($user != null){
            $jumlah_keranjang = Keranjang::where('user_id', $user->id)->count();
        }
        return response()->json(['jumlah_keranjang'=>$jumlah_keranjang]);
    }

    public function get_data_diskon($id){
        $data_produk = array();
        $produk = Produk::find($id);
        if(!empty($produk)){
            $data_produk['id'] = $produk->id;
            $data_produk['nama_produk'] = $produk->nama;
            if($produk->diskon != null){
                $data_produk['diskon'] = $produk->diskon->diskon;
                $data_produk['diskon_mulai'] = $produk->diskon->diskon_mulai;
                $data_produk['diskon_akhir'] = $produk->diskon->diskon_akhir;
            }
            else{
                $data_produk['diskon'] = 0;
                $data_produk['diskon_mulai'] = "-";
                $data_produk['diskon_akhir'] = "-";
            }
        }

        return response()->json(['data_diskon'=>$data_produk]);
        
    }

    public function get_total_pesanan($id){
        $nota = Nota::find($id);
        $total_sub_harga = 0;
        $ongkir = $nota->ongkos_kirim;
        $total_harga = 0;
        foreach($nota->pesanan as $pesanan){
            $total_sub_harga += $pesanan->jumlah * $pesanan->harga_satuan;
        }

        $total_harga = $total_sub_harga + $ongkir;

        $data = array();
        $data['total_sub_harga'] = $total_sub_harga;
        $data['ongkir'] = $ongkir;
        $data['total_harga'] = $total_harga;

        return response()->json(['data'=>$data]);
    }
}
