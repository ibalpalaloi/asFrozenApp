<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Kota;
use App\Models\Kecamatan;
use App\Models\Kelurahan;
use App\Models\Ongkos_kirim;

class WilayahController extends Controller
{
    //
    public function kota(){
        $kota = Kota::all();
        return view('admin.kota', compact('kota'));
    }

    public function post_kota(Request $request){
        $kota = new Kota;
        $kota->kota = $request->kota;
        $kota->save();
        return back();
    }

    public function list_kecamatan($id){
        $kecamatan = Kecamatan::where('kota_id', $id)->get();
        $kota = Kota::find($id);
        return view('admin.list_kecamatan', compact('kecamatan', 'kota'));
    }

    public function post_kecamatan(Request $request){
        $kecamatan = new Kecamatan;
        $kecamatan->kota_id = $request->kota_id;
        $kecamatan->kecamatan = $request->kecamatan;
        $kecamatan->save();

        return back();
    }
}
