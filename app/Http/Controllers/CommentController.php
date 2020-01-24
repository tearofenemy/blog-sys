<?php

namespace App\Http\Controllers;

use App\Http\Requests\CommentsRequest;
use App\Post;

class CommentController extends Controller
{
    public function store(Post $post, CommentsRequest $request)
    {
        $post->comments()->create($request->all());
        return redirect()->back()->with('s_message', "Your comment was successfully sent.");
    }
}