<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Foundation\Auth\RegistersUsers;
use GuzzleHttp\Client;


class AuthController extends Controller
{

	public function register(Request $request){
		return $request->input('name');
	}

    public function login(Request $request){
    	return $request->input('name');
    }
}
