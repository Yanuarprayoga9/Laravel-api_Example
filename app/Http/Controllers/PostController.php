<?php

namespace App\Http\Controllers;

use App\Http\Resources\PostResource;
use App\Models\Post;
use Illuminate\Http\Request;

class PostController extends Controller
{
    public function index(){
        $post = Post::all();
        // return response()->json(['status'=> "Success",'Data'=>$post]);
        return PostResource::collection($post);
    }
    public function show($id){
        $post = Post::find($id);
        return response()->json(['status'=> "Success",'Data'=>$post]);
    }
}
