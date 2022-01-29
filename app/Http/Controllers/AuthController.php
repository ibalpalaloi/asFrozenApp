<?php

namespace App\Http\Controllers;

use App\Mail\SendPassword;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use App\Models\User;
use App\Models\Biodata;
use App\Models\User_lupa_password;
use Auth;
use Illuminate\Support\Facades\Mail;

class AuthController extends Controller
{
    //

    public function user_login(){
        return view('auth.user_login');
    }

    public function registrasi(){
        return view('auth.registrasi');
    }

    public function post_registrasi(Request $request){
        $validator = Validator::make($request->all(), [
            'nama'=> 'required',
            'no_telp' => 'required',
            'email'  => 'required',
            'jenis_kelamin'  => 'required',
            'password'  => 'required'
        ]);

        $user = new User;
        $user->name = $request->nama;
        $user->email = $request->email;
        $user->no_telp = $request->no_telp;
        $user->role = 'user';
        $user->password = bcrypt($request->password);
        $user->save();

        $biodata = new Biodata;
        $biodata->user_id = $user->id;
        $biodata->nama = $request->nama;
        $biodata->jenis_kelamin = $request->jenis_kelamin;
        $biodata->no_telp = $request->no_telp;
        $biodata->save();

        if(Auth::attempt(['no_telp' => $request->no_telp, 'password'=>$request->password])){
            return redirect('/');
        }

        return redirect('/');
    }

    public function logout(){
        Auth::logout();
        return redirect('/');
    }

    public function post_login(Request $request){
        $no_telp = $request->no_telp;
        $password = $request->password;

        if(Auth::attempt(['no_telp' => $no_telp, 'password'=>$password])){
            User_lupa_password::where('user_id', Auth()->user()->id)->delete();
            
            if(Auth()->user()->blokir == "true"){
                return redirect('/user_login');
            }
            return redirect('/');
        }
        $cek_lupa_password = $this->cek_lupa_password($no_telp, $password);
        if($cek_lupa_password){
            if(Auth::attempt(['no_telp' => $no_telp, 'password'=>$password])){
                User_lupa_password::where('user_id', Auth()->user()->id)->delete();
                
                if(Auth()->user()->blokir == "true"){
                    return redirect('/user_login');
                }
                return redirect('/');
            }
        }
        return back();
    }

    public function cek_lupa_password($no_telp, $password){
        $user = User::where('no_telp', $no_telp)->first();
        if(!empty($user)){
            $cek_lupa_password = User_lupa_password::where([
                ['user_id', $user->id],
                ['password_baru', $password]
            ])->first();
            if(!empty($cek_lupa_password)){
                $user->password = bcrypt($password);
                $user->save();
                return true;
            }
            return false;
        }
        return false;
    }

    public function admin_login(){
        return view('auth.admin_login');
    }

    public function post_admin_login(Request $request){
        $name = $request->name;
        $password = $request->password;

        if(Auth::attempt(['name' => $name, 'password'=>$password])){
            return redirect('/admin-index');
        }
        return back();
    }

    public function lupa_password(){
        return view('auth.lupa_password');
    }

    public function post_lupa_password(Request $request){
        $user = User::where('no_telp', $request->no_telp)->first();
        if(!empty($user)){
            $cek_lupa_password = User_lupa_password::where('user_id', $user->id)->first();
            if(empty($cek_lupa_password)){
                $lupa_password = new User_lupa_password;
                $lupa_password->user_id = $user->id;
                $random_password = $this->random_password();
                $lupa_password->password_baru = $random_password;
                $lupa_password->save();

                $this->kirim_email_password_baru($user->email, $random_password, $user->no_telp);
                return redirect('/user_login')->with('success', 'Password Baru Akan DiKirimkan Ke Whatsapp Anda');
            }
            $this->kirim_email_password_baru($user->email, $cek_lupa_password->password_baru, $user->no_telp);
            return redirect('/user_login')->with('success', 'Password Baru Akan DiKirimkan Ke Whatsapp Anda');
        }
        return back()->with('error', 'Akun Tidak Tersedia');
    }

    public function random_password() {
        $characters = '0123456789abcdefghijklmnopqrstuvwxyz';
        $randomString = '';
      
        for ($i = 0; $i < 8; $i++) {
            $index = rand(0, strlen($characters) - 1);
            $randomString .= $characters[$index];
        }
      
        return $randomString;
    }

    public function kirim_email_password_baru($email, $password, $no_telp){
        $detail = [
            'title'=>'nPassword Baru',
            'body'=>'Password baru akun = '.$no_telp.', password baru = '.$password
        ];
        Mail::to($email)->send(new SendPassword($detail));
    }
}
