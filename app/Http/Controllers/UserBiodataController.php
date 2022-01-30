<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;

class UserBiodataController extends Controller
{
    //
    public function ubah_password(){
        return view('user.ubah_password.ubah_password');
    }

    public function post_ubah_password(Request $request){
        $user = User::where('id', Auth()->user()->id)->first();
        if(!empty($user)){
            $user->password = bcrypt($request->password);
            $user->save();
            return back()->with(['success', 'Password berhasil diubah']);
        }
        return back()->with(['error', 'User tidak di temukan']);
    }
    
}
