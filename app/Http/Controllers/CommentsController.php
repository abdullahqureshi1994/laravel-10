<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Comment;

class CommentsController extends Controller
{
    public function addComment(Request $request) {
        $comment = new Comment;
        $comment->user_id = auth()->user()->id;
        $comment->post_id = $request->post_id;
        $comment->comment = $request->comment;
        $comment->save();

        return response('Comment added to post successfully');
    }

    public function getComment(Request $request, $id) {
        $comment = Comment::find($id);
        if(!$comment)
            return response('Comment not found', 404);

        return response($comment);
    }

    public function getPostComments(Request $request, $id) {
        $comments = Comment::where('post_id', $id)->get();
        return response($comments);
    }

    public function getUserComments(Request $request) {
        $comments = Comment::where('user_id', auth()->user()->id)->get();
        return response($comments);
    }

    public function deleteComment(Request $request, $id) {
        Comment::find($id)->delete();
        return response('Comment deleted successfully');
    }

    public function updateComment(Request $request, $id) {
        $comment = Comment::find($id)->delete();
        $comment->comment = $request->comment;
        $comment->save();

        return response('Comment updated successfully');
    }
}
