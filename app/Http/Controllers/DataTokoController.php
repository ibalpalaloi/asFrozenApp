<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Data_toko;
use Illuminate\Support\Facades\Validator;

class DataTokoController extends Controller
{
    //
    public function data_toko(){
        $data = Data_toko::all();
        return view('admin.data_toko', compact('data'));
    }

    public function post_ubah_data(Request $request){
        $validator = Validator::make($request->all(), [
            'nilai' => 'required'
        ]);

        if($validator->fails()){
            return back()->with('error', 'Pastikan Data Terisi!!');
        }

        $data = Data_toko::find($request->id);
        $data->nilai = $request->nilai;
        $data->save();

        return back();
    }
}
