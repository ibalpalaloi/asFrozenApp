<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Testimoni;
use App\Models\Riwayat_nota_pesanan;
class UserTestimoniController extends Controller
{
    //
	public function index(){
		$riwayat = Riwayat_nota_pesanan::where('user_id', Auth()->user()->id)->get();
		// dd($riwayat);
		$testimoni = Testimoni::where('users_id', Auth()->user()->id)->first();
		return view('user/testimoni/index', compact('testimoni', 'riwayat'));
	}

	public function store(Request $request){
		Testimoni::where('users_id', Auth()->user()->id)->delete();
		$db = new Testimoni;
		$db->text = $request->text;
		$db->tester = Auth()->user()->biodata->nama;
		$db->users_id = Auth()->user()->id;
		$db->save();
		$notification = array(
			'kode-notif' => 'berhasil',
			'message' => 'Data berhasil ditambah',
			'color' => "#28a745",
			'icon' => "fas fa-check-circle",
			'header' => "Berhasil"
		); 
		return back()->with($notification); 
	}

	public function delete(Request $request){
		Testimoni::where('id', $request->id)->delete();
		$notification = array(
			'kode-notif' => 'berhasil',
			'message' => 'Data berhasil dihapus',
			'color' => "#28a745",
			'icon' => "fas fa-check-circle",
			'header' => "Berhasil"
		); 
		return back()->with($notification);  

	}
}
