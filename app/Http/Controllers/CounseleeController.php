<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Resources\Counselor as CounselorResource;
use App\Counselor;
use App\Counselee;
use Validator;

class CounseleeController extends Controller
{
    public function index(){
    	return auth()->user();
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
            'phoneNumber' => 'required'
        ];

        //run the validator
        $validator = Validator::make($data, $rules);

        if($validator->passes()){
        	//create new counselee object
        	$counselee = new Counselee();

        	$counselee->name = $request->input('name');
        	$counselee->phoneNumber = $request->input('phoneNumber');
        	$counselee->profileImage = "image.jpg";
            $counselee->user_id = auth()->user()->id;

        	if($counselee->save()){
        		return response(['user'=> auth()->user(), 'counselee'=> $counselee]);
        	}

        }
        else{
        	return $validator->errors()->all();
        }
    }

    public function viewCounselors(){
    	//fetch all counselors
    	$counselors = Counselor::all();

    	return CounselorResource::collection($counselors);
    }

    public function viewCounselor($id){
    	//fetch specific counselor
    	$counselor = Counselor::findorFail($id);

    	return new CounselorResource($counselor);
    }

    

}
