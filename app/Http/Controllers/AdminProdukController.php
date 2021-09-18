<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Kategori;
use App\Models\Produk;
use App\Models\Diskon;
use Illuminate\Support\Facades\Validator;

class AdminProdukController extends Controller
{
    //
    public function kategori(){
        return view('admin.kategori');
    }

    public function tambah_produk(){
        $kategori = kategori::all();
        return view('admin.tambah_produk', compact('kategori'));
    }

    public function admin_post_produk_baru(Request $request){
        $valdiator = Validator::make($request->all(), [
            'kategori' => 'required', 
            'sub_kategori' => 'required',
            'nama_produk' => 'required',
            'satuan' => 'required',
            'harga' => 'required',
            'foto_produk' => 'required|mimes:jpg,png,jpeg',
        ]);
        if($valdiator->fails()){
            return back()->with('error', 'Kesalahan Penginputan data!!');
        }

        $cek_produk = Produk::where('nama', $request->nama_produk)->get();
        if(count($cek_produk)>0){
            return back()->with('error', 'Nama Produk Telah Tersedia!!');
        }

        $produk = new Produk;
        $produk->nama = $request->nama_produk;
        $produk->harga = $request->harga;
        $produk->satuan = $request->satuan;
        $produk->deskripsi = $request->deskripsi;
        $produk->kategori_id = $request->kategori;
        $produk->sub_kategori_id = $request->sub_kategori;
        $produk->save();

        $file = $request->file('foto_produk');
        $lokasi = "img/produk";
        $foto = "produk-".$produk->id.".".$file->getClientOriginalExtension();
        $file->move($lokasi, $foto);

        $produk->foto = $foto;
        $produk->save();

        if($request->diskon != null){
            $diskon = new Diskon;
            $diskon->produk_id = $produk->id;
            $diskon->diskon = $request->diskon; 
            $diskon->save();
            
        }

        return back()->with('success', 'Produk tersimpan');
    }

    public function daftar_produk(){
        $produk = Produk::all();
        return view('admin.daftar_produk', compact('produk'));
    }
}
