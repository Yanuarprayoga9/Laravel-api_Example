<?php

namespace App\Http\Controllers;

use App\Models\Post;
use Illuminate\Http\Request;
use App\Http\Resources\PostResource;
use App\Http\Resources\PostDetailResource;
use Illuminate\Support\Facades\Auth;

class PostController extends Controller
{
    public function index(){
        $post = Post::all();
        // return response()->json(['status'=> "Success",'Data'=>$post]);
        return PostResource::collection($post->loadMissing('writer:id,username'));
    }
    public function show($id){
        $post = Post::with('writer')->find($id);
        // return response()->json(['status'=> "Success",'Data'=>$post]);
        return new PostDetailResource($post);
    }
    public function store(Request $request){
        $validated = request()->validate([
            'title' => 'required',
            'news_content' => 'required',
        ]);
        $request['author'] =Auth::user()->id;
        $post = Post::create($request->all());
        return new PostDetailResource($post->loadMissing('writer:id,username'));
    }

    public function update(Request $request, $id){
        $validated = request()->validate([
            'title' => 'required',
            'news_content' => 'required',
        ]);
        $post = Post::find($id);
        $post->update($request->all());
        return new PostDetailResource($post->loadMissing('writer:id,username'));
    }
    public function delete($id){
        $post = Post::find($id);
        $post->delete();
        return response()->json(['status'=> "Success",'Data'=>$post]);
    }
 

    
}
