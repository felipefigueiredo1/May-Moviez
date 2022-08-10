<?php

namespace App\Http\Controllers;

use App\Models\Comment;
use Illuminate\Support\Facades\Redirect;
use Inertia\Inertia;
use Illuminate\Http\Request;
use App\Models\Post;

class PostController extends Controller
{
    public function index()
    {
        $user = auth()->user()->id;
        return Inertia::render('Post', ['user' => $user]);
    }

    public function store(Request $request)
    {
        Post::create($request->all());
        return Redirect::route('moviez');
    }

    public function show($id)
    {
        $user = auth()->user()->id;
        $post = Post::with('comments')->findOrFail($id);
        //$comments = $post->comments()->with('user')->get();
        $comments = $post->comments()->with('user')->paginate(2);
       //dd($comments);
        return Inertia::render('Show', ['post' => $post, 'user' => $user, 'comments' => $comments]);
    }
}
