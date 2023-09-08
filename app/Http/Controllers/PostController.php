<?php

namespace App\Http\Controllers;

use App\Models\Post;
use Illuminate\Http\Request;
use App\Http\Resources\PostResource;
use App\Http\Resources\PostDetailResource;

class PostController extends Controller
{
    public function index(){
        $post = Post::all();
        // return response()->json(['status'=> "Success",'Data'=>$post]);
        return PostResource::collection($post);
    }
    public function show($id){
        $post = Post::with('writer')->find($id);
        // return response()->json(['status'=> "Success",'Data'=>$post]);
        return new PostDetailResource($post);
    }
    public function store(){
        $post = Post::create([
            'title' => 'test',
            'news_content' => 'test',
            'author' => 'test',
        ]);
        return response()->json(['status'=> "Success",'Data'=>$post]);
    }
}
