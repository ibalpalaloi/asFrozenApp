<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Kategori;
use App\Models\Banner;
use App\Models\Sub_kategori;
use Illuminate\Support\Facades\Validator;
use Jenssegers\Agent\Agent;
use Image;

class AdminKategoriController extends Controller
{
    //
    public function kategori(){
        $kategori = Kategori::orderBy('urutan', 'asc')->get();
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
        $urutan = 1;
        $urutan_terakhir = Kategori::max("urutan");
        if($urutan_terakhir != null){
            $urutan = $urutan_terakhir+1;
        }
        $kategori = new Kategori;
        $kategori->kategori = $request->kategori;
        $kategori->urutan = $urutan;

        if ($request->file('logo')) {
            $file = $request->file('logo');
            $logo = "kategori-".$this->autocode('ktgr').".".$file->getClientOriginalExtension();
            \Storage::disk('public')->put("icon_kategori/$logo", file_get_contents($file));
            \Storage::disk('public')->put("icon_kategori/thumbnail/75x75/$logo", file_get_contents($file));
            \Storage::disk('public')->put("icon_kategori/thumbnail/150x150/$logo", file_get_contents($file));
            $img = Image::make("public/icon_kategori/thumbnail/75x75/$logo")->fit(75,75);
            $img->save();
            $img = Image::make("public/icon_kategori/thumbnail/150x150/$logo")->fit(150,150);
            $img->save();
            $kategori->logo = $logo;
        }
        $kategori->save();
        $notification = array(
            'kode-notif' => 'berhasil',
            'message' => 'Data berhasil ditambah',
            'color' => "#28a745",
            'icon' => "fas fa-check-circle",
            'header' => "Berhasil"
        ); 
        return back()->with($notification);  
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

        $notification = array(
            'kode-notif' => 'berhasil',
            'message' => 'Data berhasil ditambah',
            'color' => "#28a745",
            'icon' => "fas fa-check-circle",
            'header' => "Berhasil"
        ); 
        return back()->with($notification);  
    }

    public function post_update_kategori(Request $request){
        $kategori = Kategori::where('id', $request->kategori_id)->first();
        $kategori->kategori = $request->kategori;
        if ($request->file('logo')) {
            \File::delete("public/icon_kategori/$kategori->logo");                 
            $file = $request->file('logo');
            $logo = "kategori-".$this->autocode('ktgr').".".$file->getClientOriginalExtension();
            \Storage::disk('public')->put("icon_kategori/$logo", file_get_contents($file));
            \Storage::disk('public')->put("icon_kategori/thumbnail/75x75/$logo", file_get_contents($file));
            \Storage::disk('public')->put("icon_kategori/thumbnail/150x150/$logo", file_get_contents($file));
            $img = Image::make("public/icon_kategori/thumbnail/75x75/$logo")->fit(75,75);
            $img->save();
            $img = Image::make("public/icon_kategori/thumbnail/150x150/$logo")->fit(150,150);
            $img->save();
            $kategori->logo = $logo;
        }
        $kategori->save();

        $notification = array(
            'kode-notif' => 'berhasil',
            'message' => 'Data berhasil diubah',
            'color' => "#28a745",
            'icon' => "fas fa-check-circle",
            'header' => "Berhasil"
        ); 
        return back()->with($notification);  
    }

    public function post_update_sub_kategori(Request $request){
        $sub_kategori = Sub_kategori::find($request->sub_kategori_id);
        $sub_kategori->sub_kategori = $request->sub_kategori;
        $sub_kategori->save();
        return back();
    }

    public function delete_kategori(Request $request){
        $kategori = Kategori::where('id', $request->id)->first();       
        // dd($kategori); 
        \File::delete("public/icon_kategori/$kategori->logo");                 
        \File::delete("public/icon_kategori/thumbnail/75x75/$kategori->logo"); 
        \File::delete("public/icon_kategori/thumbnail/150x150/$kategori->logo"); 
        Sub_kategori::where('kategori_id', $request->id)->delete();                
        Kategori::where('id', $request->id)->delete();        
        $notification = array(
            'kode-notif' => 'berhasil',
            'message' => 'Data berhasil dihapus',
            'color' => "#28a745",
            'icon' => "fas fa-check-circle",
            'header' => "Berhasil"
        ); 
        return back()->with($notification);  
    }

    public function autocode($kode){
        $timestamp = time(); 
        $random = rand(10, 100);
        $current_date = date('mdYs'.$random, $timestamp); 
        return $kode.$current_date;
    }   

    public function ubah_urutan(Request $request){
        $kategori_ = Kategori::find($request->id_kategori);
        $kategori = Kategori::where('urutan', $request->urutan)->first();
        
        $urutan_sekarang = $kategori_->urutan;
        $urutan_ubah = $request->urutan;

        $kategori_->urutan = $urutan_ubah;
        $kategori_->save();

        $kategori->urutan = $urutan_sekarang;
        $kategori->save();

        return back();
    }
}
