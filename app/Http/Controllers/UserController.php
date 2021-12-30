<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class UserController extends Controller
{
    public function __construct()
    {
    	$this->middleware('auth');
    }

    public function index(Request $request)
    {
    	if ($request->user()->hasRole('user')) {
    		return view('user/index');
    	} else {
    		return redirect('/');
    	}
    }
}
