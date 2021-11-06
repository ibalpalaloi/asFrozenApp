<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Waktu_buka;
use App\Models\Waktu_tutup;
use Illuminate\Support\Facades\Validator;

class JadwalController extends Controller
{
    //
    public function jadwal_buka(){
        $jadwal = Waktu_buka::all();

        return view('admin.jadwal_buka', compact('jadwal'));
    }

    public function get_jadwal_buka($id){
        $jadwal = Waktu_buka::find($id);
        return response()->json(['jadwal'=>$jadwal]);
    }

    public function ubah_jadwal(Request $request){
        $jadwal = Waktu_buka::where('hari', $request->hari)->first();
        $jadwal->waktu_buka = $request->jam_buka;
        $jadwal->waktu_tutup = $request->jam_tutup;
        $jadwal->keterangan = $request->keterangan;
        $jadwal->save();

        return back();
    }

    public function jadwal_tutup(){
        date_default_timezone_set( 'Asia/Singapore' ) ;
        $date_today = date("Y-m-d");
        Waktu_tutup::where('tgl_tutup', '<', $date_today)->delete();
        $jadwal = Waktu_tutup::where('tgl_tutup', '>=', $date_today)->orderBy('tgl_tutup', 'asc')->get();
        $data_jadwal = array();
        $i = 0;
        foreach($jadwal as $data){
            $timestamp = strtotime($data->tgl_tutup);
            $new_date = date("d-M-Y", $timestamp);
            $data_jadwal[$i]['id'] = $data->id;
            $data_jadwal[$i]['tgl'] = $new_date;
            $data_jadwal[$i]['ket'] = $data->keterangan;
            $i++;
        }
        return view('admin.jadwal_tutup', compact('data_jadwal'));
    }

    public function post_tambah_tgl_tutup(Request $request){
        $valdiator = Validator::make($request->all(), [
            'tgl_tutup' => 'required',
        ]);
        if($valdiator->fails()){
            return back()->with('error', 'Kesalahan Penginputan data!!');
        }

        $cek_tgl = Waktu_tutup::where('tgl_tutup', $request->tgl_tutup)->get();
        if(count($cek_tgl)>0){
            return back()->with('error', 'Tanggal Telah tersedia');
        }

        $jadwal = new Waktu_tutup;
        $jadwal->tgl_tutup = $request->tgl_tutup;
        $jadwal->keterangan = $request->keterangan;
        $jadwal->save();

        return back();
    }

    public function hapus_jadwal_tutup($id){
        Waktu_tutup::where('id', $id)->delete();
        return back();
    }
}
