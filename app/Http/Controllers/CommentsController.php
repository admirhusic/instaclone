<?php

namespace App\Http\Controllers;

use App\Comment;
use Illuminate\Http\Request;

class CommentsController extends Controller
{

    public function store(Request $request)
    {
        $request->validate(['comment' => 'required|max:160']);


        Comment::create([
            'user_id' => auth()->user()->id,
            'post_id' => $request->post_id,
            'body' => $request->comment
        ]);

        return back();
    }
}
