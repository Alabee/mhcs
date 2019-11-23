<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Foundation\Auth\RegistersUsers;
//use GuzzleHttp\Client;
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
            'email' => 'email|required|unique:users',  
            'password' => 'required|confirmed'
        ];

        //run the validator
        $validator = Validator::make($data, $rules);

        if($validator->passes()){
            //encrypt the password input
            $data['password'] = bcrypt($data['password']);
            //create user
            $user = User::create($data);

            //generate access token for client
            $accessToken = $user->createToken('authToken')->accessToken;

            return response(['user'=> $user, 'access_token'=>$accessToken]);
        }
        else{
            return $validator->errors()->all();
        }
        

    }

    public function login(Request $request){
        //json_decode() is used to decode a json string to an array/data object. json_encode() creates a json string from an array or data
        $data = json_decode(json_encode($request->all()), true);

        //rules for validation of fields
        $rules = [
            'email' => 'email|required',  
            'password' => 'required'
        ];

        //run the validator
        $validator = Validator::make($data, $rules);

        if($validator->passes()){
            //authenticate user
            if (!auth()->attempt($data)) {
                return response(['message'=>'Invalid credentials']);
            }

            //generate access token for client
            $accessToken = auth()->user()->createToken('authToken')->accessToken;

            return response(['user'=> auth()->user(), 'access_token'=>$accessToken]);
        }
        else{
            return $validator->errors()->all();
        }
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

    public function login_test(Request $request){
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
