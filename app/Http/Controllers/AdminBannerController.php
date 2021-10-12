<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Banner;
use Image;

class AdminBannerController extends Controller
{
    //
    public function banner(){
        $banner_main = Banner::where('posisi', 'main')->get();
        $banner_not_main = Banner::where('posisi', '!=', 'main')->orderBy('posisi', 'asc')->get();
        $menu = "data dukung";
        $sub_menu = 'banner';
        return view('admin.banner', compact('banner_main', 'banner_not_main', 'menu', 'sub_menu'));
    }

    public function update_side(Request $request){
    	$banner = Banner::where('id', $request->id)->first();
        if ($request->file('banner')) {
            \File::delete("banner/$banner->foto");                 
            \File::delete("banner/thumbnail/488x150/$banner->foto");                 
            $file = $request->file('banner');
            $logo = "banner-".$this->autocode('bnr').".".$file->getClientOriginalExtension();
            \Storage::disk('public')->put("banner/$logo", file_get_contents($file));
            \Storage::disk('public')->put("banner/thumbnail/488x150/$logo", file_get_contents($file));
            $img = Image::make("banner/thumbnail/488x150/$logo")->fit(488,150);
            $img->save();
            $banner->foto = $logo;
        }
        $banner->save();
        return redirect()->back();
    }	

    public function store_side(Request $request){
        if ($request->file('banner')){
            $file = $request->file('banner');
            $logo = "banner-".$this->autocode('bnr').".".$file->getClientOriginalExtension();
            \Storage::disk('public')->put("banner/$logo", file_get_contents($file));
            \Storage::disk('public')->put("banner/thumbnail/488x150/$logo", file_get_contents($file));
            $img = Image::make("banner/thumbnail/488x150/$logo")->fit(488,150);
            $img->save();
            $banner = new Banner;
            $banner->foto = $logo;
            $banner->posisi = 'main';
            $banner->save();           
        }
        return redirect()->back();
    }

    public function delete(Request $request){
        $banner = Banner::where('id', $request->id)->first();
        \File::delete("banner/$banner->foto");                 
        \File::delete("banner/thumbnail/488x150/$banner->foto");    
        $banner->delete();             
        return redirect()->back();
    }

    public function autocode($kode){
        $timestamp = time(); 
        $random = rand(10, 100);
        $current_date = date('mdYs'.$random, $timestamp); 
        return $kode.$current_date;
    }   
}
