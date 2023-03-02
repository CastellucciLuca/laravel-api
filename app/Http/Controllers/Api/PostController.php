<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Post;
use Illuminate\Http\Request;

class PostController extends Controller
{
    public function index() {
        $posts = Post::paginate(25);
        return response()->json([
            'success'=>true,
            'results'=>$posts
        ]);
    }
    public function show(Post $post){
        return response()->json([
            'success'=>true,
            'results'=>$post
        ]);
    }
}
