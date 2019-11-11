<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Foundation\Auth\RegistersUsers;
use GuzzleHttp\Client;

class AuthController extends Controller
{

	public function register(Request $request){
		return dd($request);
	}

    public function login(Request $request){
    	
    }
}
