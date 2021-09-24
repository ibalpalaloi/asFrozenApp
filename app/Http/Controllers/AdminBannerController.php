<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Banner;

class AdminBannerController extends Controller
{
    //
    public function banner(){
        $banner = Banner::all();
        $menu = "data dukung";
        $sub_menu = 'banner';
        return view('admin.banner', compact('banner', 'menu', 'sub_menu'));
    }
}
