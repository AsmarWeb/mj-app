<?php

namespace App\Http\Controllers;

use App\Models\Post;
use Illuminate\Http\Request;


class CommentController extends Controller
{



    public function store(Request $request, Post $post)
    {

        $data=$request->validate([

            'comment'=>'required|string|max:1000'

        ]);



        $comment=$post->comments()->create([

            'user_id'=>auth()->id(),

            'comment'=>$data['comment']

        ]);



        return back();

    }

}