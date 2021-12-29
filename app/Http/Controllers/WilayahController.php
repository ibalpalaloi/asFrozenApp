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

    public function ongkos_kirim(){
        $kelurahan = Kelurahan::all();
        $ongkos_kirim = array();
        $i = 0;
        foreach($kelurahan as $data){
            $ongkos_kirim[$i]['id_kelurahan'] = $data->id;
            $ongkos_kirim[$i]['kelurahan'] = $data->kelurahan;
            if($data->ongkos_kirim){
                $ongkos_kirim[$i]['ongkir'] = $data->ongkos_kirim->ongkos_kirim;
            }else{
                $ongkos_kirim[$i]['ongkir'] = 0;
            }
            $i++;
        }
        return view('admin.ongkos_kirim', compact('ongkos_kirim'));
    }

    public function kelurahan(){
        $kota = Kota::all();
        $data_kelurahan = array();
        $i = 0;
        foreach($kota as $data){
            foreach($data->kecamatan as $kecamatan){
                foreach($kecamatan->kelurahan as $kelurahan){
                    $data_kelurahan[$i]['kota'] = $data->kota;
                    $data_kelurahan[$i]['kecamatan'] = $kecamatan->kecamatan;
                    $data_kelurahan[$i]['kelurahan'] = $kelurahan->kelurahan;
                    $i++;
                }
            }
        }
        return view('admin.list_kelurahan', compact('data_kelurahan', 'kota'));

    }

    public function post_kelurahan(Request $request){
        $kelurahan = new Kelurahan;
        $kelurahan->kecamatan_id = $request->kecamatan;
        $kelurahan->kelurahan = $request->kelurahan;
        $kelurahan->save();

        return back();

    }

    public function post_ubah_ongkir(Request $request){
        $ongkir = Ongkos_kirim::where('kelurahan_id', $request->id_kelurahan)->first();
        if(empty($ongkir)){
            $ongkir = new Ongkos_kirim;
            $ongkir->kelurahan_id = $request->id_kelurahan;
            $ongkir->ongkos_kirim = $request->ongkir;
            $ongkir->save();
        }else{
            $ongkir->ongkos_kirim = $request->ongkir;
            $ongkir->save();
        }

        return back();
    }
}
