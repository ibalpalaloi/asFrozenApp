<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Kategori;
use App\Models\Sub_kategori;
use Illuminate\Support\Facades\Validator;

class AdminKategoriController extends Controller
{
    //
    public function kategori(){
        $kategori = Kategori::all();
        return view('admin.kategori', compact('kategori'));
    }

    public function post_kategori_baru(Request $request){
        $valdiator = Validator::make($request->all(), [
            'kategori' => 'required', 
            'logo' => 'required'
        ]);
        if($valdiator->fails()){
            return back()->with('error', 'Kesalahan Penginputan File!!');
        }

        $cek_kategori = Kategori::where('kategori', $request->kategori)->get();
        if(count($cek_kategori) > 0){
            return back()->with('error', 'Nama Kategori Telah Tersedia');
        }

        // cek urutan
        $urutan = 1;
        $urutan_terakhir = Kategori::max("urutan");
        if($urutan_terakhir != null){
            $urutan = $urutan_terakhir+1;
        }
        //
        

        $kategori = new Kategori;
        $kategori->kategori = $request->kategori;
        $kategori->urutan = $urutan;
        $kategori->save();

        $file = $request->file('logo');

        $kategori->logo = "kategori-".$kategori->id.".".$file->getClientOriginalExtension();
        $kategori->save();

        $lokasi = "icon_kategori";
        $file->move($lokasi, $kategori->logo);
        
        return redirect('/admin-kategori');
    }

    public function admin_post_sub_kategori_baru(Request $request){
        $valdiator = Validator::make($request->all(), [
            'kategori_id' => 'required', 
            'sub_kategori' => 'required'
        ]);
        if($valdiator->fails()){
            return back()->with('error', 'Kesalahan Penginputan data!!');
        }

        $cek_sub_kategori = Sub_kategori::where([
            ['kategori_id', $request->kategori_id], ['sub_kategori', $request->sub_kategori]
        ])->get();

        if(count($cek_sub_kategori) > 0){
            return back()->with('error', 'Nama Sub Kategori Telah ada!!');
        }

        $sub_kategori = new Sub_kategori;
        $sub_kategori->kategori_id = $request->kategori_id;
        $sub_kategori->sub_kategori = $request->sub_kategori;
        $sub_kategori->save();

        return back();
    }

    public function post_update_kategori(Request $request){
        $kategori = Kategori::find($request->kategori_id);
        $kategori->kategori = $request->kategori;
        $kategori->save();

        return back();
    }

    public function post_update_sub_kategori(Request $request){
        $sub_kategori = Sub_kategori::find($request->sub_kategori_id);
        $sub_kategori->sub_kategori = $request->sub_kategori;
        $sub_kategori->save();
        return back();
    }
}
