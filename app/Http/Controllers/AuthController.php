<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Foundation\Auth\RegistersUsers;
use GuzzleHttp\Client;
//use GuzzleHttp\Psr7\Request;

class AuthController extends Controller
{
    public function register(Request $request){
        $validatedData = $request->validate([
            'email' => 'email|required',  
            'password' => 'required|confirmed'
        ]);

        //User::create($validatedData);
        return "Successful";

    }
    
	public function register_test(Request $request){
		//return $request->input('email');

		$client = new Client();

    	$response = $client->request('POST', "http://mhcs.dev/register", [
    		'form_params' => [
    			'name' => "Ian",
    			'email' => $request->input('email'),
    			'password' => $request->input('password')
    		]
    	]);

    	return $response;
	}

    public function login(Request $request){
    	//return $request->input('name');

    	$client = new Client([
    		// Base URI is used with relative requests
		    'base_uri' => 'http://httpbin.org',
		    // You can set any number of default request options.
		    'timeout'  => 2.0,
		]);

    	$response = $client->request('POST', "http://mhcs.dev/login", [
    		'form_params' => [
    			'email' => $request->input('email'),
    			'password' => $request->input('password')
    		]
    	]);

    	return $response;
    }
}
