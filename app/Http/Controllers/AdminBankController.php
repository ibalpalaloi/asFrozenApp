<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Bank;
class AdminBankController extends Controller
{
    //
    public function index(){
    	$bank = Bank::all();
    	return view('admin/bank/index', compact('bank'));
    }

    public function store(Request $request){
    	$db = new Bank;
    	$db->nama_bank = $request->nama_bank;
    	$db->nomor_rekening = $request->nomor_rekening;
        $db->nama = $request->nama;
		if ($request->file('logo_bank')) {
			$nama_file = $this->autocode('BNK');
			$files = $request->file('logo_bank');
			$type = $files->getClientOriginalExtension();
			$file_upload = $nama_file.".".$type;
			\Storage::disk('public')->put("bank/".$file_upload, file_get_contents($files));
			$db->img = $file_upload;
		}
		$db->save();
		$notification = array(
			'message' => 'Bank Berhasil Tersimpan', 
			'alert-type' => 'success'
		); 
		return redirect()->back()->with($notification);
    }

    public function update(Request $request){
        $db = Bank::where('id', $request->id)->first();
        $db->nama_bank = $request->nama_bank;
        $db->nomor_rekening = $request->nomor_rekening;
        $db->nama = $request->nama;
        if ($request->file('logo_bank')) {
            $nama_file = $this->autocode('BNK');
            $files = $request->file('logo_bank');
            $type = $files->getClientOriginalExtension();
            $file_upload = $nama_file.".".$type;
            \Storage::disk('public')->put("bank/".$file_upload, file_get_contents($files));
            $db->img = $file_upload;
        }
        $db->save();
        $notification = array(
            'message' => 'Bank Berhasil diubah', 
            'alert-type' => 'success'
        ); 
        return redirect()->back()->with($notification);
    }

    public function autocode($kode){
        $timestamp = time(); 
        $random = rand(10, 100);
        $current_date = date('mdYs'.$random, $timestamp); 
        return $kode.$current_date;
    } 
}



