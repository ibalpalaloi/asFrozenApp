<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Kategori;
use App\Models\Produk;

class UserKatalogController extends Controller
{
    //
    public function index(){
        $kategori = Kategori::orderBy('urutan')->get();
        $kategori_show = Kategori::withCount('produk')->orderBy('produk_count', 'desc')->paginate(3);
        return view('user.index', compact('kategori', 'kategori_show'));
    }

    public function kategori($kategori){
        $list_kategori = Kategori::where('kategori', '!=', $kategori)->get();
        $kategori_current = Kategori::where('kategori', $kategori)->first();
        return view('user.kategori', compact('list_kategori', 'kategori_current'));
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
