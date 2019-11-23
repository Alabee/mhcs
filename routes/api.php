<?php

use Illuminate\Http\Request;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/

Route::middleware('auth:api')->get('/user', function (Request $request) {
    return $request->user();
});

//Authentication endpoints
Route::post('register', 'AuthController@register');
Route::post('login', 'AuthController@login');


//The following routes are protected by Passport. Therefore, the API consumers should specify their access token as a Bearer token in the Authorization header of their request.
Route::group(['middleware' => ['auth:api']], function(){
	//Blog management endpoints for both counselor and counselee
	Route::get('blogs', 'BlogController@index');
	Route::get('blog/{id}', 'BlogController@view');
	Route::post('blog/create', 'BlogController@create');
	Route::post('blog/update', 'BlogController@update'); //should include a blog_id field with the id of the blog being updates

	//Counselees endpoints
	Route::get('counselee', 'CounseleeController@index');

	Route::post('counselee/profile_save', 'CounseleeController@profileSave');
	Route::get('counselee/profile', 'CounseleeController@profile');
	
	Route::get('counselee/view_counselors', 'CounseleeController@viewCounselors');
	Route::get('counselee/view_counselor/{id}', 'CounseleeController@viewCounselor');


});


