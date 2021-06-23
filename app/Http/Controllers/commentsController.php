<?php

namespace App\Http\Controllers;

use App\Comment;
use Illuminate\Http\Request;

class commentsController extends Controller
{

    public function store(Request $request)
    {
        Comment::create([
            'user_id' => $request->user_id,
            'product_id' => $request->product_id,
            'comment' => $request->comment,
        ]);

        $comment_id = Comment::where('user_id' ,$request->user_id)->orderBy('id', 'desc')->first()->id;
        return response()->json([
            'comment_id' => $comment_id,
        ]);
    }


    public function update(Request $request)
    {
        Comment::find($request->id)->update([
           'comment' => $request->comment,
        ]);
    }


    public function destroy(Request $request)
    {
        Comment::destroy($request->id);
    }
}
