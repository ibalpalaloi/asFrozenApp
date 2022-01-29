<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use App\Models\Biodata;
use App\Models\User_lupa_password;

class AdminUserController extends Controller
{
    //

    public function daftar_pengguna(){
        $user = User::where([
            ['role', 'user'],
            ['blokir', 'false']
        ])->get();
        $data_user = array();
        $i = 0;
        foreach($user as $data){
            $data_user[$i]['id_user'] = $data->id;
            $data_user[$i]['nama'] = $data->name;
            $data_user[$i]['email'] = $data->email;
            $data_user[$i]['no_telp'] = $data->no_telp;
            if($data->biodata){
                $data_user[$i]['alamat'] =$data->biodata->alamat;
            }else{
                $data_user[$i]['alamat'] = "";
            }
            $i++;
        }
        return view('admin.daftar_pengguna', compact('data_user'));
    }

    public function post_ubah_pengguna(Request $request){
        $user = User::find($request->id_user);
        $user->email = $request->email;
        $user->no_telp = $request->no_telp;
        $user->password = bcrypt($request->password);
        $user->save();

        $biodata = Biodata::where('user_id', $request->id_user)->first();
        if(!empty($biodata)){
            $biodata->no_telp = $request->no_telp;
            $biodata->save();
        }

        return back();

    }

    public function banned_pengguna($id){
        $user = User::find($id);
        if($user->blokir == "false"){
            $user->blokir = "true";
        }else{
            $user->blokir = "false";
        }
        
        $user->save();

        return response()->json(['status'=>"sukses"]);
    }

    public function daftar_pengguna_banned(){
        $user = User::where('blokir', 'true')->get();
        $data_user = array();
        $i = 0;
        foreach($user as $data){
            $data_user[$i]['id_user'] = $data->id;
            $data_user[$i]['nama'] = $data->name;
            $data_user[$i]['email'] = $data->email;
            $data_user[$i]['no_telp'] = $data->no_telp;
            if($data->biodata){
                $data_user[$i]['alamat'] =$data->biodata->alamat;
            }else{
                $data_user[$i]['alamat'] = "";
            }
            $i++;
        }

        return view('admin.daftar_pengguna_banned', compact('data_user'));
    }

    public function hapus_pengguna($id){
        $user = User::find($id)->delete();
        Biodata::where('user_id', $id)->delete();

        return response()->json(['status'=>"sukses"]);
    }

    public function lupa_password(){
        $user = User_lupa_password::all();
        return view('admin.daftar_lupa_password', compact('user'));
    } 
}
