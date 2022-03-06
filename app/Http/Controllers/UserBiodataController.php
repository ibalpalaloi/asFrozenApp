<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use Jenssegers\Agent\Agent;


class UserBiodataController extends Controller
{
    //
    public function ubah_password(){
        $user = User::where('id', Auth()->user()->id)->first();
        $agent = new Agent();
        if ($agent->isMobile()){
            return view('user.ubah_password.ubah_password_mobile', compact('user'));
        }
        else {
            return view('user.ubah_password.ubah_password');
        }

    }

    public function post_ubah_password(Request $request){
        $user = User::where('id', Auth()->user()->id)->first();
        if(!empty($user)){
            $user->password = bcrypt($request->password);
            $user->save();
            return redirect('/biodata')->with(['success', 'Password berhasil diubah']);
        }
        return redirect('/biodata')->with(['error', 'User tidak di temukan']);
    }
    
}
