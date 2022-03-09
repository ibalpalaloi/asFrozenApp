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
use Carbon\CarbonPeriod;
use PDF;

class AdminProdukController extends Controller
{
    //
    public function kategori(){
        return view('admin.kategori');
    }

    public function tambah_produk(){
        $kategori = kategori::all();
        $menu = 'produk';
        $sub_menu = "tambah produk";
        return view('admin.tambah_produk', compact('kategori', 'menu', 'sub_menu'));
    }

    public function admin_post_produk_baru(Request $request){
        $valdiator = Validator::make($request->all(), [
            'kategori' => 'required', 
            'nama_produk' => 'required',
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
        $produk->harga = str_replace(',', '', $request->harga);
        $produk->satuan = $request->satuan;
        $produk->deskripsi = $request->deskripsi;
        $produk->kategori_id = $request->kategori;
        $produk->sub_kategori_id = 0;
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
            $img = Image::make("public/img/produk/thumbnail/500x500/$foto")->fit(500,500);
            $img->save();
            $img = Image::make("public/img/produk/thumbnail/300x300/$foto")->fit(300,300);
            $img->save();
            $produk->foto = $foto;
        }

        $produk->save();

        // if($request->diskon != null){
        //     $diskon = new Diskon;
        //     $diskon->produk_id = $produk->id;
        //     $diskon->diskon = $request->diskon; 
        //     $diskon->save();

        // }

        return back()->with('success', 'Produk tersimpan');
    }

    public function autocode($kode){
        $timestamp = time(); 
        $random = rand(10, 100);
        $current_date = date('mdYs'.$random, $timestamp); 
        return $kode.$current_date;
    }  

    public function daftar_produk(Request $request){
        $kategori = Kategori::all();
        $jumlah_produk = Produk::count();
        $produk = Produk::orderBy('kategori_id', 'asc')->orderBy('nama', 'asc')->paginate(30);
        // dd($produk);
        $list_produk = array();
        $i=0;
        foreach($produk as $data){
            $list_produk[$i]['id'] = $data->id;
            $list_produk[$i]['nama'] = $data->nama;
            $list_produk[$i]['foto'] = $data->foto;
            $list_produk[$i]['diskon_id'] = $data->diskon->id ?? 0;
            $list_produk[$i]['diskon_mulai'] = $data->diskon->diskon_mulai ?? null;
            $list_produk[$i]['diskon_akhir'] = $data->diskon->diskon_akhir ?? null;
            $list_produk[$i]['harga'] = $data->harga;
            $list_produk[$i]['satuan'] = $data->satuan;
            $list_produk[$i]['kategori'] = $data->kategori->kategori ?? "Belum ada kategori";
            $list_produk[$i]['sub_kategori'] = "-";
            if($data->sub_kategori != null){
                $list_produk[$i]['sub_kategori'] = $data->sub_kategori->sub_kategori;
            }
            
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
        // dd($list_produk);
        $menu = 'produk';
        $sub_menu = "daftar produk";
        if(count($request->all()) != 0){
            $keyword = $request->keyword;
            $page = $request->page;
            if(count($list_produk) == 30){
                $page++;
                $status_scroll = true;
            }
            else{
                $status_scroll = false;
            }
            $view = view('admin.include.data_daftar_produk', compact('list_produk', 'menu', 'sub_menu'))->render();
            return response()->json(['view'=>$view, 'page'=>$page, 'status_scroll'=>$status_scroll]);
        }
        return view('admin.daftar_produk', compact('list_produk', 'menu', 'sub_menu', 'kategori', 'jumlah_produk'));
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
            $diskon->diskon_mulai = $request->tgl_mulai;
            $diskon->diskon_akhir = $request->tgl_akhir;
            $diskon->save();
        }
        else{
            $diskon = Diskon::where('produk_id', $request->id)->first();
            $diskon->diskon = $request->diskon;
            $diskon->diskon_mulai = $request->tgl_mulai;
            $diskon->diskon_akhir = $request->tgl_akhir;
            $diskon->save();
        }

        return response()->json(['status'=>$status]);
    }

    public function post_update_produk(Request $request){
        $produk = Produk::find($request->id);
        $produk->nama = $request->nama;
        // $produk->harga = str_replace(',', '', $request->harga);
        // $produk->satuan =  $request->satuan;
        // $produk->kategori_id = $request->kategori;
        // $produk->sub_kategori_id = $request->sub_kategori;

        if ($request->file('foto')) {
            if ($produk->foto != 'image_not_available.png'){
                \File::delete("public/img/produk/$produk->foto");                 
                \File::delete("public/img/produk/thumbnail/500x500/$produk->foto");                 
                \File::delete("public/img/produk/thumbnail/300x300/$produk->foto");                 
            }
            $file = $request->file('foto');
            $foto = "produk-".$this->autocode('prd').".".$file->getClientOriginalExtension();
            \Storage::disk('public')->put("img/produk/$foto", file_get_contents($file));
            \Storage::disk('public')->put("img/produk/thumbnail/500x500/$foto", file_get_contents($file));
            \Storage::disk('public')->put("img/produk/thumbnail/300x300/$foto", file_get_contents($file));
            $img = Image::make("public/img/produk/thumbnail/500x500/$foto")->fit(500,500);
            $img->save();
            $img = Image::make("public/img/produk/thumbnail/300x300/$foto")->fit(300,300);
            $img->save();
            $produk->foto = $foto;
        }
        $produk->save();

        $produk = Produk::find($request->id);
        $data_produk = array();
        $data_produk['id'] = $produk->id;
        $data_produk['nama'] = $produk->nama;
        $data_produk['harga'] = "Rp. ".number_format($produk->harga, 0, ".", ".");
        $data_produk['satuan'] = $produk->satuan;
        $data_produk['kategori'] = $produk->kategori->kategori;
        $data_produk['foto'] = $produk->foto;
        if($produk->sub_kategori != null){
            $data_produk['sub_kategori'] = $produk->sub_kategori->sub_kategori;
        }
        else{
            $data_produk['sub_kategori'] = "-";
        }
        // $data_produk = array();        


        return response()->json(['produk'=>$data_produk]);
    }

    public function diskon(Request $request){
        date_default_timezone_set( 'Asia/Singapore' ) ;
        $date_today = date("Y-m-d");
        $date_tomorrow = date("Y-m-d", strtotime("+1 day", strtotime(date("Y-m-d"))));
        $date_lusa = date("Y-m-d", strtotime("+2 day", strtotime(date("Y-m-d"))));

        if(count($request->all()) == 0){
            // $start_date = Carbon::createFromFormat('Y-m-d', '2021-09-21');
            // $end_date = Carbon::createFromFormat('Y-m-d', '2021-09-25');
            $kategori = Kategori::all();
            $diskon = Diskon::where('diskon_akhir', '>=', $date_today)->where('diskon_mulai', '<=', $date_today)->get();        
            return view('admin.diskon', compact('diskon', 'kategori'));
        }
        // $date_tomorow = date("Y-m-d", strtotime("+1 day"));
        $view_lainnya = false;

        $waktu = $request->waktu;
        if($waktu == "future"){
            $diskon = Diskon::where('diskon_akhir', '>', $date_today)->get();
        }
        elseif($waktu == "past"){
            $diskon = Diskon::where('diskon_akhir', '<', $date_today)->get();
        }
        elseif($waktu == "between"){
            $period = CarbonPeriod::create($_GET['tgl_mulai'], $_GET['tgl_akhir']);
            $date_arr = array();
            foreach ($period as $date) {
                $date_arr[date('Y-m-d', strtotime($date))] = Diskon::where('diskon_akhir', '>=', $date)->where('diskon_mulai', '<=', $date)->get(); 
            }
            $view_lainnya = true;
        }
        elseif($waktu == "now"){
            $diskon = Diskon::where('diskon_akhir', '>=', $date_today)->where('diskon_mulai', '<=', $date_today)->get();           
        }
        elseif($waktu == "tomorrow"){
            $diskon = Diskon::where('diskon_akhir', '>=', $date_tomorrow)->where('diskon_mulai', '<=', $date_tomorrow)->get();  
            // echo $date_tomorrow;         
        }
        elseif($waktu == 'lainnya'){
            $max_date = Diskon::orderBy('diskon_akhir', 'desc')->first();
            if ($max_date){
                $period = CarbonPeriod::create($date_lusa, date('Y-m-d', strtotime($max_date->diskon_akhir)));
                $date_arr = array();
                foreach ($period as $date) {
                    // echo $date."<br>";
                    $date_arr[date('Y-m-d', strtotime($date))] = Diskon::where('diskon_akhir', '>=', $date)->where('diskon_mulai', '<=', $date)->get(); 
                }
            }
            // dd($date_arr);    
            $view_lainnya = true;
        }
        else{
            $diskon = Diskon::where('diskon_akhir', '>=', $date_today)->get();
        }
        if ($view_lainnya == false){
            $view = view('admin.include.table_diskon', compact('diskon'))->render();            
        }
        else {
            $view = view('admin.include.table_diskon_lainnya', compact('date_arr'))->render();                        
        }

        return response()->json(['html'=>$view]);
    }

    public function get_data_cari_produk(Request $request){
        $keyword = $request->keyword;
        $produk = Produk::where('nama', 'LIKE', '%'.$keyword.'%')->get();
        // dd($produk);
        $list_produk = array();
        $i=0;
        foreach($produk as $data){
            $list_produk[$i]['id'] = $data->id;
            $list_produk[$i]['nama'] = $data->nama;
            $list_produk[$i]['foto'] = $data->foto;
            $list_produk[$i]['diskon_id'] = $data->diskon->id ?? 0;
            $list_produk[$i]['diskon_mulai'] = $data->diskon->diskon_mulai ?? null;
            $list_produk[$i]['diskon_akhir'] = $data->diskon->diskon_akhir ?? null;
            $list_produk[$i]['harga'] = $data->harga;
            $list_produk[$i]['satuan'] = $data->satuan;
            $list_produk[$i]['kategori'] = $data->kategori->kategori;
            if($data->sub_kategori != null){
                $list_produk[$i]['sub_kategori'] = $data->sub_kategori->sub_kategori;
            }
            else{
                $list_produk[$i]['sub_kategori'] = "-";
            }

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
        $view = view('admin.include.data_daftar_produk', compact('list_produk'))->render();
        return response()->json(['view'=>$view]);
    }

    public function hapus_produk($id){
        Produk::where('id', $id)->delete();
    }

    public function daftar_produk_kosong(Request $request){
        $produk = Produk::whereDoesntHave('stok_produk')->orWhereHas('stok_produk', function($query){
            $query->where('stok', '<=', 5);
        })->paginate(50);
        $list_produk = array();
        $i=0;
        foreach($produk as $data){
            $list_produk[$i]['id'] = $data->id;
            $list_produk[$i]['nama'] = $data->nama;
            $list_produk[$i]['foto'] = $data->foto;
            $list_produk[$i]['diskon_id'] = $data->diskon->id ?? 0;
            $list_produk[$i]['diskon_mulai'] = $data->diskon->diskon_mulai ?? null;
            $list_produk[$i]['diskon_akhir'] = $data->diskon->diskon_akhir ?? null;
            $list_produk[$i]['harga'] = $data->harga;
            $list_produk[$i]['satuan'] = $data->satuan;
            $list_produk[$i]['kategori'] = $data->kategori->kategori;
            $list_produk[$i]['sub_kategori'] = "-";
            if($data->sub_kategori != null){
                $list_produk[$i]['sub_kategori'] = $data->sub_kategori->sub_kategori;
            }
            
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
        if(count($request->all()) != 0){
            $keyword = $request->keyword;
            $page = $request->page;
            if(count($list_produk) == 50){
                $page++;
                $status_scroll = true;
            }
            else{
                $status_scroll = false;
            }
            $view = view('admin.include.data_daftar_produk', compact('list_produk'))->render();
            return response()->json(['view'=>$view, 'page'=>$page, 'status_scroll'=>$status_scroll]);
        }
        return view('admin.daftar_produk_kosong', compact('list_produk'));
    }

    public function download_produk($id){
        // dd($id);
        if ($id == "semua"){
            $kategori = "Semua Produk";
            $produk = Produk::orderBy('kategori_id', 'asc')->orderBy('nama', 'asc')->get();
        }
        else {
            $kategori = Kategori::where('id', $id)->first()->kategori;
            $produk = Produk::where('kategori_id', $id)->orderBy('nama', 'asc')->get();
        }
        $pdf = PDF::loadView('admin/produk/download', compact('produk', 'kategori'))->setOption('page-width', '215')->setOption('page-height', '297');
        return $pdf->download("Daftar Produk $kategori.pdf");

        // return view('admin/produk/download', compact('produk', 'kategori'));
    }

    public function produk_perkategori($id_kategori, Request $request){
        $kategori = Kategori::all();
        $jumlah_produk = Produk::where('kategori_id', $id_kategori)->get()->count();
        $produk = Produk::where('kategori_id', $id_kategori)->orderBy('nama', 'asc')->paginate(50);
        $list_produk = array();
        $i=0;
        foreach($produk as $data){
            $list_produk[$i]['id'] = $data->id;
            $list_produk[$i]['nama'] = $data->nama;
            $list_produk[$i]['foto'] = $data->foto;
            $list_produk[$i]['diskon_id'] = $data->diskon->id ?? 0;
            $list_produk[$i]['diskon_mulai'] = $data->diskon->diskon_mulai ?? null;
            $list_produk[$i]['diskon_akhir'] = $data->diskon->diskon_akhir ?? null;
            $list_produk[$i]['harga'] = $data->harga;
            $list_produk[$i]['satuan'] = $data->satuan;
            $list_produk[$i]['kategori'] = $data->kategori->kategori;
            $list_produk[$i]['sub_kategori'] = "-";
            if($data->sub_kategori != null){
                $list_produk[$i]['sub_kategori'] = $data->sub_kategori->sub_kategori;
            }
            
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
        if(count($request->all()) != 0){
            $keyword = $request->keyword;
            $page = $request->page;
            if(count($list_produk) == 50){
                $page++;
                $status_scroll = true;
            }
            else{
                $status_scroll = false;
            }
            $view = view('admin.include.data_daftar_produk', compact('list_produk'))->render();
            return response()->json(['view'=>$view, 'page'=>$page, 'status_scroll'=>$status_scroll]);
        }
        return view('admin.daftar_produk_perkategori', compact('list_produk', 'kategori', 'id_kategori', 'jumlah_produk'));
    }
}
