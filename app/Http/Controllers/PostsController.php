<?php

namespace App\Http\Controllers;

use App\Post;
use Illuminate\Http\Request;
use Intervention\Image\Facades\Image;

class PostsController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * get action come from route Postscontroller@index
     * $users : get all following users
     * $posts : get all posts by passing by user ids
     * return view - posts.view
     */
    public function index()
    {
        $users = auth()->user()->following->pluck('user_id');
        $posts = Post::whereIn('user_id', $users)->with('user')->latest()->paginate(1);
        return view('posts.index', compact('posts'));

    }

    /**
     * view post create page
     */
    public function create()
    {
        return view('posts.create');
    }

    /**
     * When click Add new post button
     */
    public function store()
    {
        $data = request()->validate([
            'caption' => 'required',
            'image'   => ['required','image']
        ]);

        $imagePath = request('image')->store('uploads','public');
        $image = Image::make(public_path("storage/{$imagePath}"))->fit(1200, 1200);
        $image->save();

        auth()->user()->posts()->create([
            'caption' => $data['caption'],
            'image' => $imagePath
        ]);

        return redirect('/profile/'.auth()->id());

    }

    /**
     * @param Post $post
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     * Showing single post
     */
    public function show(Post $post)
    {
        return view('posts.show', compact('post'));
    }
}
