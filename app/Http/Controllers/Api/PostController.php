<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Resources\PostResource;
use Illuminate\Http\Request;
use App\Models\Post;
use Illuminate\Support\Facades\Validator;

class PostController extends Controller
{
    public function index()
    {
        $posts = Post::all();
        return new PostResource(true, 'List data', $posts);
    }

    public function store(Request $request)
    {

        $posts = Post::create($request->all());

        return response()->json([
            'data' => $posts,
            'message ' => 'data berhasil ditambahkan!',
        ], 200);
    }

    public function show(Post $post)
    {

        return response()->json([
            'posts' => $post
        ]);
    }

    public function update(Request $request, Post $posts, $id)
    {
        $posts = Post::find($id);
        $posts->nama = $request->nama;
        $posts->email = $request->email;
        $posts->alamat = $request->alamat;
        $posts->save();
        return response()->json([
            'status' => true,
            'message' => "Post Updated successfully!",
            'data' => $posts
        ], 200);
    }


    public function destroy(Post $post)
    {
        $post->delete();
        return response()->json([
            'data' => 'empty',
            'message' => 'data berhasil di hapus!',
        ], 200);
    }
}
