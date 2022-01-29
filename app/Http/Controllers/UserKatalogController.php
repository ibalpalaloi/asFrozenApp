<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Kategori;
use App\Models\Produk;
use App\Models\Banner;
use Jenssegers\Agent\Agent;
use App\Models\Diskon;
use App\Models\Testimoni;

class UserKatalogController extends Controller
{
    //
    public function index(){
        date_default_timezone_set( 'Asia/Singapore' ) ;
        $date_today = date("Y-m-d");
        $kategori = Kategori::select('id', 'kategori', 'logo')->orderBy('urutan', 'asc')->get();
        $flash_sale = Diskon::where('diskon_akhir', '>=', $date_today)->get();

        $kategori_show = Kategori::withCount('produk')->orderBy('produk_count', 'desc')->paginate(3);
        $agent = new Agent();
        $banner_main = Banner::where('posisi', 'main')->get();
        $banner_not_main = Banner::where('posisi', '!=', 'main')->orderBy('posisi', 'asc')->get();
        $testimoni = Testimoni::get();
        // dd($testimoni);
        if ($agent->isMobile()){
            return view('home.landing_page.mobile', compact('kategori', 'kategori_show', 'flash_sale', 'banner_main', 'banner_not_main'));
        }
        else {
            return view('home.landing_page.desktop', compact('kategori', 'kategori_show', 'flash_sale', 'banner_main', 'banner_not_main', 'testimoni'));            
        }
    }

    public function kategori($kategori){
        $list_kategori = Kategori::all();
        $kategori_current = Kategori::where('kategori', $kategori)->first();
        $agent = new Agent();
        if ($agent->isMobile()){
            $dummy = Produk::where('kategori_id', $kategori_current->id)->get();
            // dd($dummy);
            return view('home.kategori.mobile', compact('list_kategori', 'kategori_current', 'dummy'));            
        }        
        else {
            return view('home.kategori.desktop', compact('list_kategori', 'kategori_current'));                        
        }
    }

    public function get_produK_sub_kategori(Request $request){
        $sub_kategori = $request->sub_kategori;
        $jenis = $request->jenis;

        if($jenis == 'semua'){
            $kategori_current = Kategori::where('kategori', $sub_kategori)->first();
            $view = view('home.kategori.sub_kategori.desktop', compact('kategori_current'))->render();
        }else{
            $produk = Produk::where('sub_kategori_id', $request->sub_kategori)->get();
            $view = view('user.data_katalog_sub_kategori', compact('produk'))->render();
        }

        return response()->json(['html'=>$view]);
    }

    public function pencarian(Request $request){
        $page = $request->page;
        if($page == null){
            $page = 1;
        }
        $keyword = $request->keyword;
        $kategori = Kategori::all();
        $produk = Produk::where('nama', 'LIKE', '%'.$keyword.'%')->paginate(40);
        $list_page = $this->get_pagination_page_produk($keyword, 40);
        return view('user.pencarian.desktop', compact('kategori', 'keyword', 'produk', 'page', 'list_page', 'page'));
    }

    public function get_pagination_page_produk($keyword, $paginate){
        $produk = Produk::where('nama', 'LIKE', '%'.$keyword.'%')->count();
        $jumlah_page = ceil($produk / $paginate);
        $list_page = array();
        for($i = 0; $i < $jumlah_page; $i++){
            $list_page[$i] = $i+1;
        }

        return $list_page;
    }
}
