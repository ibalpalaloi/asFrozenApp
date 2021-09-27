<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Kategori;
use App\Models\Produk;
use App\Models\Banner;
use Jenssegers\Agent\Agent;
use App\Models\Diskon;

class UserKatalogController extends Controller
{
    //
    public function index(){
        date_default_timezone_set( 'Asia/Singapore' ) ;
        $date_today = date("Y-m-d");
        $kategori = Kategori::orderBy('urutan')->get();
        $banner = Banner::all();
        $flash_sale = Diskon::where('diskon_akhir', '>=', $date_today)->get();

        $kategori_show = Kategori::withCount('produk')->orderBy('produk_count', 'desc')->paginate(3);
        $agent = new Agent();
        if ($agent->isMobile()){
            return view('home.landing_page.mobile', compact('kategori', 'kategori_show', 'flash_sale'));
        }
        else {
            return view('home.landing_page.desktop', compact('kategori', 'kategori_show', 'flash_sale'));            
        }
    }

    public function kategori($kategori){
        $list_kategori = Kategori::where('kategori', '!=', $kategori)->get();
        $kategori_current = Kategori::where('kategori', $kategori)->first();
        $agent = new Agent();
        if ($agent->isMobile()){
            return view('home.kategori.mobile', compact('list_kategori', 'kategori_current'));            
        }        
        else {
            return view('home.kategori.desktop', compact('list_kategori', 'kategori_current'));                        
        }
    }

    public function get_produK_sub_kategori(Request $request){
        $sub_kategori = $request->sub_kategori;
        $jenis = $request->jenis;

        if($jenis == 'semua'){
            $kategori = Kategori::where('kategori', $sub_kategori)->first();
            $view = view('user.sub_kategori_semua', compact('kategori'))->render();
        }else{
            $produk = Produk::where('sub_kategori_id', $request->sub_kategori)->get();
            $view = view('user.data_katalog_sub_kategori', compact('produk'))->render();
        }

        return response()->json(['html'=>$view]);
    }
}
