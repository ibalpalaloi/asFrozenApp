<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use App\Models\Diskon;

class AdminController extends Controller
{
    //
    public function index(){
        date_default_timezone_set( 'Asia/Singapore' ) ;
        $date_today = date("Y-m-d");
        Diskon::where('diskon_akhir', '<', $date_today)->delete();
        return view('admin.index');
    }

    public function ubah_password(){
        return view('admin.ubah_password');
    }

    public function post_ubah_password(Request $request){
        $user = User::find(Auth()->user()->id);
        $user->password = bcrypt($request->password);
        $user->save();

        return back()->with(['success'=>"password berhasil diubah"]);
    }
}
