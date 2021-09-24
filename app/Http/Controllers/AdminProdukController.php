<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Kategori;
use App\Models\Produk;
use App\Models\Diskon;
use App\Models\Stok_produk;
use Illuminate\Support\Facades\Validator;
use File;
use Image;
use Carbon\Carbon;

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

        if ($request->file('foto_produk')) {
            $file = $request->file('foto_produk');
            $foto = "produk-".$this->autocode('prd').".".$file->getClientOriginalExtension();
            \Storage::disk('public')->put("img/produk/$foto", file_get_contents($file));
            \Storage::disk('public')->put("img/produk/thumbnail/500x500/$foto", file_get_contents($file));
            \Storage::disk('public')->put("img/produk/thumbnail/300x300/$foto", file_get_contents($file));
            $img = Image::make("img/produk/thumbnail/500x500/$foto")->fit(500,500);
            $img->save();
            $img = Image::make("img/produk/thumbnail/300x300/$foto")->fit(300,300);
            $img->save();
        }

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

    public function autocode($kode){
        $timestamp = time(); 
        $random = rand(10, 100);
        $current_date = date('mdYs'.$random, $timestamp); 
        return $kode.$current_date;
    }  

    public function daftar_produk(){
        $produk = Produk::all();
        $list_produk = array();
        $i=0;
        foreach($produk as $data){
            $list_produk[$i]['id'] = $data->id;
            $list_produk[$i]['nama'] = $data->nama;
            $list_produk[$i]['foto'] = $data->foto;
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
            $diskon->tgl_mulai = $request->tgl_mulai;
            $diskon->tgl_akhir = $request->tgl_akhir;
            $diskon->save();
        }
        else{
            $diskon = Diskon::where('produk_id', $request->id)->first();
            $diskon->diskon = $request->diskon;
            $diskon->tgl_mulai = $request->tgl_mulai;
            $diskon->tgl_akhir = $request->tgl_akhir;
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

        if ($request->file('foto')) {
            \File::delete("img/produk/$produk->foto");                 
            \File::delete("img/produk/thumbnail/500x500/$produk->foto");                 
            \File::delete("img/produk/thumbnail/300x300/$produk->foto");                 
            $file = $request->file('foto');
            $foto = "produk-".$this->autocode('prd').".".$file->getClientOriginalExtension();
            \Storage::disk('public')->put("img/produk/$foto", file_get_contents($file));
            \Storage::disk('public')->put("img/produk/thumbnail/500x500/$foto", file_get_contents($file));
            \Storage::disk('public')->put("img/produk/thumbnail/300x300/$foto", file_get_contents($file));
            $img = Image::make("img/produk/thumbnail/500x500/$foto")->fit(500,500);
            $img->save();
            $img = Image::make("img/produk/thumbnail/300x300/$foto")->fit(300,300);
            $img->save();
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

    public function diskon(Request $request){
        date_default_timezone_set( 'Asia/Singapore' ) ;
        $date_today = date("Y-m-d");
        if(count($request->all()) == 0){
            // $start_date = Carbon::createFromFormat('Y-m-d', '2021-09-21');
            // $end_date = Carbon::createFromFormat('Y-m-d', '2021-09-25');
            $diskon = Diskon::where('diskon_akhir', '>=', $date_today)->get();
            return view('admin.diskon', compact('diskon'));
        }
        // $date_tomorow = date("Y-m-d", strtotime("+1 day"));
        $waktu = $request->waktu;
        if($waktu == "future"){
            $diskon = Diskon::where('diskon_akhir', '>', $date_today)->get();
        }
        elseif($waktu == "past"){
            $diskon = Diskon::where('diskon_akhir', '<', $date_today)->get();
        }
        elseif($waktu == "between"){
            $start_date = Carbon::createFromFormat('Y-m-d', $request->tgl_mulai);
            $end_date = Carbon::createFromFormat('Y-m-d', $request->tgl_akhir);
            $diskon = Diskon::where([
                ['diskon_mulai', '<=', $request->tgl_akhir],
                ['diskon_akhir', '>=', $request->tgl_mulai]
                ])->get();

        }
        else{
            $diskon = Diskon::where('diskon_akhir', '>=', $date_today)->get();
        }
        $view = view('admin.include.table_diskon', compact('diskon'))->render();

        return response()->json(['html'=>$view]);
    }
}
