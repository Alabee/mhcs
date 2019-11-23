<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Resources\Blog as BlogResource;
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
    	return new BlogResource($blog);
    }

    public function create(Request $request){
    	//create object for blog
    	$blog = new Blog();
 
        if(auth()->user()->role == "counselor"){
            $author = auth()->user()->counselor->name;
        }
        elseif(auth()->user()->role == "counselee"){
            $author = auth()->user()->counselee->name;
        }
        else{
            $author = "Anonymous";
        }

    	//fill the fields
    	$blog->title = $request->input('title');
    	$blog->body = $request->input('body');
    	$blog->author = $author;
        $blog->user_id = auth()->user()->id;

    	if($blog->save()){
    		return new BlogResource($blog);
    	}
    }

    public function update(Request $request){
    	//create object for blog
    	$blog = Blog::findorFail($request->input('blog_id'));

    	//fill the fields
    	$blog->title = $request->input('title');
    	$blog->body = $request->input('body');
    	$blog->author = $request->input('author');
        $blog->author_id = $request->input('author_id');


    	if($blog->save()){
    		return BlogResource($blog);
    	}
    }
}
