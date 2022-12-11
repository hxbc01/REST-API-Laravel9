<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Resources\PostResource;
use Illuminate\Http\Request;
use App\Models\Post;


class PostController extends Controller
{
    public function index()
    {
        $posts = Post::all();
        return new PostResource(true, 'List Data Post', $posts);
    }

    public function store(Request $request)
    {

       $posts = Post::create($request->all());

       return response()->json([
        'posts' => $posts
       ]);
       
    }

    public function update(Request $request, Post $posts, $id){
        $posts = Post::find($id);
        $posts->update($request->all());

        return new PostResource(
            true, 'data berhasil di update', $posts
        );
    }

    public function destroy(Post $post){
        $post->delete();
        return response()->json([
            'message' => 'data berhasil di hapus!',
        ], 200);
    }
}
