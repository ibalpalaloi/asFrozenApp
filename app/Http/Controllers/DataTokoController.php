<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Data_toko;

class DataTokoController extends Controller
{
    //
    public function data_toko(){
        $data = Data_toko::all();
        return view('admin.data_toko', compact('data'));
    }

    public function post_ubah_data(Request $request){
        $data = Data_toko::find($request->id);
        $data->nilai = $request->nilai;
        $data->save();

        return back();
    }
}
