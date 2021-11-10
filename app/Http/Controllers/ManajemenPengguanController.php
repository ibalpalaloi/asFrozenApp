<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use Illuminate\Support\Facades\Validator;

class ManajemenPengguanController extends Controller
{
    //
    public function daftar_admin(){
        $user = User::where('role', 'admin')->get();

        return view('admin.daftar_admin', compact('user'));
    }

    public function post_admin_baru(Request $request){
        $valdiator = Validator::make($request->all(), [
            'username' => 'required', 
            'email' => 'required',
            'no_telp' => 'required',
            'role' => 'required',
            'password' => 'required|min:8',
            // 'foto_produk' => 'required|mimes:jpg,png,jpeg',
        ]);
        if($valdiator->fails()){
            return back()->with('error', 'Kesalahan Penginputan data!!');
        }

        $cek_user = User::where('name', $request->username)->orWhere('email', $request->email)->get();
        if(count($cek_user) > 0){
            return back()->with('error', 'Data Tersebut Telah Tersedia!!');
        }

        $user = new User;
        $user->role = $request->role;
        $user->name = $request->username;
        $user->email = $request->email;
        $user->no_telp = $request->no_telp;
        $user->password =  bcrypt($request->password);
        $user->save();

        return back()->with('success', 'Data Tersimpan');
    }

    public function get_data_admin($id){
        $user = User::find($id);
        $data = array();

        $data['id'] = $user->id;
        $data['name'] = $user->name;
        $data['role'] = $user->role;
        $data['email'] = $user->email;
        $data['no_telp'] = $user->no_telp;

        return response()->json(['user'=>$data]);
    }

    public function post_ubah_admin(Request $request){
        $valdiator = Validator::make($request->all(), [
            'username' => 'required', 
            'email' => 'required',
            'no_telp' => 'required',
            'password' => 'required|min:8',
            // 'foto_produk' => 'required|mimes:jpg,png,jpeg',
        ]);
        if($valdiator->fails()){
            return back()->with('error', 'Kesalahan Penginputan data!!');
        }


        $user = User::find($request->id_user);
        $user->name = $request->username;
        $user->email = $request->email;
        $user->no_telp = $request->no_telp;
        $user->password = bcrypt($request->password);
        $user->save();

        return back()->with('success', 'Data Tersimpan');
    }

    public function hapus_admin($id){
        User::where('id', $id)->delete();

        return back()->with('success', 'Data Terhapus');
    }
}
