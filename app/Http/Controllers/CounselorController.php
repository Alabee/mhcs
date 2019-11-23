<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Validator;
use App\Counselor;

class CounselorController extends Controller
{
    public function index(){
    	return "Welcome";
    }

    public function profile(){
    	return "Working";
    }

    public function profileSave(Request $request){
    	//json_decode() is used to decode a json string to an array/data object. json_encode() creates a json string from an array or data
        $data = json_decode(json_encode($request->all()), true);

        //rules for validation of fields
        $rules = [
            'name' => 'required',  
            'phoneNumber' => 'required',
            'bio' => 'required'
        ];

        //run the validator
        $validator = Validator::make($data, $rules);

        if($validator->passes()){
        	//create new counselor object
        	$counselor = new Counselor();

        	$counselor->name = $request->input('name');
        	$counselor->phoneNumber = $request->input('phoneNumber');
        	$counselor->bio = $request->input('bio');
        	$counselor->profileImage = "image.jpg";

        	if($counselor->save()){
        		return response(['user'=> auth()->user(), 'counselor'=> $counselor]);
        	}

        }
        else{
        	return $validator->errors()->all();
        }
    }

    
}
