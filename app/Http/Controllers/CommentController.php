<?php

namespace App\Http\Controllers;

use App\Models\Comment;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class CommentController extends Controller
{
    public function store(Request $request){
        $validated = request()->validate([
            'comments_content' => 'required',
            'post_id' => 'required|exists:post,id',
        ]);
        $request->merge([
            'user_id' => Auth::user()->id,
        ]);
        $comment = Comment::create($request->all());
       return response()->json([
           'message' => 'comment created',
           'data' => $comment,
       ]);
    }
}
