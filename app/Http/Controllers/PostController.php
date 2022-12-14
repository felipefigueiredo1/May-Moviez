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
        $rules = [
            'name' => 'required',
            'body' => 'required',
            'rating' => 'required',
        ];
        $feedback = [
            'required' => 'O campo :attribute é requerido!',
        ];
        $request->validate($rules, $feedback);
        Post::create([
            'name' => $request->name,
            'user_id' => $request->user_id,
            'body' => $request->body,
            'rating' => $request->rating
        ]);
        return Redirect::route('moviez');
    }

    public function show($id)
    {
        $user = auth()->user()->id;
        $post = Post::with('comments')->findOrFail($id);
        $comments = $post->comments()->with('user')->paginate(5);
        return Inertia::render('Show', ['post' => $post, 'user' => $user, 'comments' => $comments]);
    }

    public function destroy($id)
    {
        Post::destroy($id);
        return redirect()->back();
    }



}
