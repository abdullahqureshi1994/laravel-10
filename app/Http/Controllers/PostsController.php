<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Post;

class PostsController extends Controller
{
    public function addPost(Request $request) {
        $post = new Post;
        $post->user_id = auth()->user()->id;
        $post->content = $request->content;
        $post->save();

        return response('Post added successfully');
    }

    public function getPost(Request $request, $id) {
        $post = Post::with('comments')->find($id);
        if(!$post)
            return response('Post not found', 404);

        return response($post);
    }

    public function getUserPosts(Request $request) {
        $posts = Post::where('user_id', auth()->user()->id)->with('comments')->get();
        return response($posts);
    }

    public function deletePost(Request $request, $id) {
        Post::find($id)->delete();
        return response('Post deleted successfully');
    }

    public function updatePost(Request $request, $id) {
        $post = Post::find($id)->delete();
        $post->content = $request->content;
        $post->save();

        return response('Post updated successfully');
    }
}
