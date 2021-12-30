<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;
use Validator;
use Hash;
use Session;
use App\User;
use App\Role;

class AuthController extends Controller
{
    public function showFormLogin()
    {
    	if (Auth::check()) {
    		return redirect()->route('home');
    	}
    	return view('login');
        // return json_encode('aaaaaa');
    }

    public function login(Request $request)
    {
    	$rules = [
    		'username'				=> 'required|string',
    		'password'				=> 'required|string'
    	];

    	$messages = [
    		'username.required'		=> 'Username Wajib Di Isi',
    		'username.string'		=> 'Username Tidak Valid',
    		'password.required'		=> 'Password Wajib Di Isi',
    		'password.string'		=> 'Password Harus Berupa String'
    	];

    	$validator = Validator::make($request->all(), $rules, $messages);

    	if ($validator->fails()) {
    		return redirect()->back()->withErrors($validator)->withInput($request->all());
    	}

    	$data = [
    		'username'	=> $request->input('username'),
    		'password'	=> $request->input('password')
    	];

    	Auth::attempt($data);

    	if (Auth::check()) {
    		return redirect()->route('home');
    	} else {
    		Session::flash('error', 'Username atau Password Salah');
    		return redirect()->route('login');
    	}
    }

    public function showFormRegister()
    {
    	return view('register');
    }

    public function register(Request $request)
    {
    	// echo "<pre>";
    	// 	print_r($_POST);
    	// echo "</pre>";
    	// die();
    	$rules = [
            'name'                  => 'required|min:3|max:35',
            'username'              => 'required|string|unique:users,username',
            'password'              => 'required|confirmed'
        ];
 
        $messages = [
            'name.required'         => 'Nama Lengkap wajib diisi',
            'name.min'              => 'Nama lengkap minimal 3 karakter',
            'name.max'              => 'Nama lengkap maksimal 35 karakter',
            'username.required'     => 'Username wajib diisi',
            'username.string'       => 'Username tidak valid',
            'username.unique'       => 'Username sudah terdaftar',
            'password.required'     => 'Password wajib diisi',
            'password.confirmed'    => 'Password tidak sama dengan konfirmasi password'
        ];
 
        $validator = Validator::make($request->all(), $rules, $messages);
 
        if($validator->fails()){
            return redirect()->back()->withErrors($validator)->withInput($request->all);
        }

        $extension = $request->file('imgupload')->extension();
        $imgname = date('dmyHis').'.'.$extension;
        $this->validate($request, [ 'imgupload' => 'required|file|max:5000']);
        $path = Storage::putFileAs('public/images', $request->file('imgupload'), $imgname);

        $user = new User;
        $user->id = null;
        $user->name = ucwords(strtolower($request->name));
        $user->username = strtolower($request->username);
        $user->password = Hash::make($request->password);
        $user->path = $path;
        $simpan = $user->save(); 
        // $user->email_verified_at = \Carbon\Carbon::now();
        $user->roles()->attach(Role::where('name','user')->first());

		// return $user;

        if($simpan){
            Session::flash('success', 'Register berhasil! Silahkan login untuk mengakses data');
            return redirect()->route('login')->with('user');
        } else {
            Session::flash('errors', ['' => 'Register gagal! Silahkan ulangi beberapa saat lagi']);
            return redirect()->route('register');
        }

    }

    public function logout()
    {
        Auth::logout(); // menghapus session yang aktif
        return redirect()->route('login');
    }
}
