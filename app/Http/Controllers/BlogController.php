<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Resource\Blog as BlogResource;
use App\Blog;

class BlogController extends Controller
{
    public function index(){
    	//get all blogs
    	$blogs = Blog::paginate(8);

    	//return collection of blogs as a collection
    	return BlogResource::collection($blogs);
    }

    public function view($id){
    	//get blog post
    	$blog = Blog::findorFail($id);

    	//return single blog as a resource
    	return BlogResource($blog);
    }
}
