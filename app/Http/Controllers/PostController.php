<?php

namespace App\Http\Controllers;

use App\Models\Listing;
use App\Models\Post;
use App\Models\Section;
use App\Models\Shop;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class PostController extends Controller
{


   public function index()
    {

        $posts = Post::with([
            'user',
            'media',
            'likes',
            'comments.user'
        ])
        ->latest()
        ->paginate(10);



        $trendingProducts = Listing::with([
            'shop',
            'section'
        ])
        ->where('status', 'published')
        ->latest()
        ->take(8)
        ->get();



        $shops = Shop::with('user')
        ->latest()
        ->take(6)
        ->get();



        $sections = Section::where('status','active')
        ->take(8)
        ->get();



        return view('posts.index', [

            'posts' => $posts,

            'trendingProducts' => $trendingProducts,

            'shops' => $shops,

            'sections' => $sections

        ]);

    }



    public function store(Request $request)
    {
        $validated = $request->validate([

            'caption' => [
                'nullable',
                'string',
                'max:2000'
            ],

            'images' => [
                'nullable',
                'array',
                'max:5'
            ],

            'images.*' => [
                'image',
                'mimes:jpg,jpeg,png,webp',
                'max:5120'
            ]

        ]);



        $post = Post::create([

            'user_id' => Auth::id(),

            'caption' => $validated['caption'] ?? null

        ]);



        if($request->hasFile('images')){


            foreach($request->file('images') as $image){


                $path = $image->store(
                    'posts',
                    'public'
                );


                $post->media()->create([

                    'file_path'=>$path,

                    'file_type'=>$image->getMimeType()

                ]);

            }

        }



        return redirect()
            ->route('posts.index')
            ->with('success','Post created');

    }
}