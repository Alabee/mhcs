<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Foundation\Auth\RegistersUsers;
use GuzzleHttp\Client;
//use GuzzleHttp\Psr7\Request;
use Validator;
use App\User;

class AuthController extends Controller
{
    public function register(Request $request){
        //json_decode() is used to decode a json string to an array/data object. json_encode() creates a json string from an array or data
        $data = json_decode(json_encode($request->all()), true);

        //rules for validation of fields
        $rules = [
            'email' => 'email|required',  
            'password' => 'required|confirmed'
        ];

        //run the validator
        $validator = Validator::make($data, $rules);

        if($validator->passes()){
            //create user
            $user = User::create($data);

            $accessToken = $user->createToken('authToken')->accessToken;

            return response(['user'=> $user, 'access_token'=>$accessToken]);
        }else{
            return $validator->errors()->all();
        }

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
