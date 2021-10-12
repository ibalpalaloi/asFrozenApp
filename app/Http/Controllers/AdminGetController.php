<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Produk;
use App\Models\Diskon;
use App\Models\Sub_kategori;
class AdminGetController extends Controller
{
    //
	public function get_produk($id){
		$diskon = Diskon::where('id', $id)->first();
		$produk = array(
			'diskon' => $diskon->diskon,
			'diskon_mulai' => $diskon->diskon_mulai,
			'diskon_akhir' => $diskon->diskon_akhir,
			'produk' => $diskon->produk->nama,
			'harga' => $diskon->produk->harga,
			'potongan_harga' => round($diskon->produk->harga*$diskon->diskon/100,0)
		);
		// dd($produk);
		echo json_encode($produk);
	}

	public function get_sub_kategori($kategori_id){
		$sub_kategori = Sub_kategori::where('kategori_id', $kategori_id)->get();
		echo json_encode($sub_kategori);
	}

	public function get_produk_from_sub($sub_kategori_id){
		$produk = Produk::where('sub_kategori_id', $sub_kategori_id)->get();
		echo json_encode($produk);
	}
}
