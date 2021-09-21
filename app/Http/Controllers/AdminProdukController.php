<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Kategori;
use App\Models\Produk;
use App\Models\Diskon;
use App\Models\Stok_produk;
use Illuminate\Support\Facades\Validator;
use File;

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
            'stok' => 'required',
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

        $stok = new Stok_produk;
        $stok->produk_id = $produk->id;
        $stok->stok = $request->stok;
        $stok->save();

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
        $list_produk = array();
        $i=0;
        foreach($produk as $data){
            $list_produk[$i]['id'] = $data->id;
            $list_produk[$i]['nama'] = $data->nama;
            $list_produk[$i]['harga'] = $data->harga;
            $list_produk[$i]['satuan'] = $data->satuan;
            $list_produk[$i]['kategori'] = $data->kategori->kategori;
            $list_produk[$i]['sub_kategori'] = $data->sub_kategori->sub_kategori;
            if($data->diskon != null){
                $list_produk[$i]['diskon'] = $data->diskon->diskon;
            }
            else{
                $list_produk[$i]['diskon'] = 0;
            }

            if($data->stok_produk != null){
                $list_produk[$i]['stok'] = $data->stok_produk->stok;
            }
            else{
                $list_produk[$i]['stok'] = 0;
            }
            $i++;
        }
        return view('admin.daftar_produk', compact('list_produk'));
    }

    public function post_ubah_stok(Request $request){
        $valdiator = Validator::make($request->all(), [
            'id' => 'required', 
            'stok' => 'required',
        ]);

        $status = "Success";

        if($valdiator->fails()){
            $status = "Error";
        }

        $cek_stok = Stok_produk::where('produk_id', $request->id)->first();
        if($cek_stok == null){
            $stok = new Stok_produk;
            $stok->produk_id = $request->id;
            $stok->stok = $request->stok;
            $stok->save();
        }
        else{
            $stok = Stok_produk::where('produk_id', $request->id)->first();
            $stok->stok = $request->stok;
            $stok->save();
        }

        return response()->json(['status'=>$status]);
    }

    public function post_ubah_diskon(Request $request){
        $valdiator = Validator::make($request->all(), [
            'id' => 'required', 
            'diskon' => 'required',
        ]);

        $status = "Success";

        if($valdiator->fails()){
            $status = "Error";
        }

        $cek_diskon = Diskon::where('produk_id', $request->id)->first();
        if($cek_diskon == null){
            $diskon = new Diskon;
            $diskon->produk_id = $request->id;
            $diskon->diskon = $request->diskon;
            $diskon->batas_diskon = $request->batas_tanggal;
            $diskon->save();
        }
        else{
            $diskon = Diskon::where('produk_id', $request->id)->first();
            $diskon->diskon = $request->diskon;
            $diskon->batas_diskon = $request->batas_tanggal;
            $diskon->save();
        }

        return response()->json(['status'=>$status]);
    }

    public function post_update_produk(Request $request){
        $produk = Produk::find($request->id);
        $produk->nama = $request->nama;
        $produk->harga = $request->harga;
        $produk->satuan =  $request->satuan;
        $produk->kategori_id = $request->kategori;
        $produk->sub_kategori_id = $request->sub_kategori;
        


        $file = $request->file('foto');
        if($file != null){
            $lokasi = "img/produk";
            File::delete($lokasi."/".$produk->foto);
            
            $foto = "produk-".$produk->id.".".$file->getClientOriginalExtension();
            $file->move($lokasi, $foto);
            $produk->foto = $foto;
        }
        $produk->save();

        $produk = Produk::find($request->id);

        $data_produk['id'] = $produk->id;
        $data_produk['nama'] = $produk->nama;
        $data_produk['harga'] = $produk->harga;
        $data_produk['satuan'] = $produk->satuan;
        $data_produk['kategori'] = $produk->kategori->kategori;
        $data_produk['sub_kategori'] = $produk->sub_kategori->sub_kategori;
        

        return response()->json(['produk'=>$data_produk]);
    }
}
