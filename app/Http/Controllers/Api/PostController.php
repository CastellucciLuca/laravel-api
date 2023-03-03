<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Post;
use Illuminate\Http\Request;

class PostController extends Controller
{
    public function index() {
        $posts = Post::with('type','technologies')->paginate(30);
        return response()->json([
            'success'=>true,
            'results'=>$posts
        ]);
    }
    public function show(Post $post){
        $post = Post::with('type','technologies')->findOrFail($post->id);
        return response()->json([
            'success'=>true,
            'results'=>$post
        ]);
    }
}
