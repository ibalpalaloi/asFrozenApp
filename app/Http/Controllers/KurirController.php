<?php

namespace App\Http\Controllers;

use App\Models\Kurir;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class KurirController extends Controller
{
    //
    public function data_kurir(){
        $kurir = Kurir::all();

        return view('admin.data_kurir', compact('kurir'));
    }

    public function post_data_kurir(Request $request){
        $validator = Validator::make($request->all(), [
            'nama' => 'required',
            'no_telp' => 'required'
        ]);

        if($validator->fails()){
            return back()->with('error', 'Lengkapi Data');
        }

        $cek_kurir = Kurir::where('nama', $request->nama)->get();
        if(count($cek_kurir) == 0){
            $kurir  = new Kurir;
            $kurir->nama = $request->nama;
            $kurir->no_telp = $request->no_telp;
            $kurir->save();
        }
        else{
            return back()->with('error', 'Nama Sudah Tersedia');
        }
        

        return back();
    }

    public function post_ubah_kurir(Request $request){
        $validator = Validator::make($request->all(), [
            'nama' => 'required',
            'no_telp' => 'required'
        ]);

        if($validator->fails()){
            return back()->with('error', 'Lengkapi Data');
        }

        $cek_kurir = Kurir::where('nama', $request->nama)->where('id', '!=', $request->id )->get();
        if(count($cek_kurir) == 0){
            $kurir  = Kurir::find($request->id);
            $kurir->nama = $request->nama;
            $kurir->no_telp = $request->no_telp;
            $kurir->save();
        }
        else{
            return back()->with('error', 'Nama Sudah Tersedia');
        }

        return back();
    }
}
