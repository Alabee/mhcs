<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class CounselorController extends Controller
{
    public function test(){
    	return "Controller is working";
    }

    public function profile_save(Request $request){
    	return "Working";
    }
}
