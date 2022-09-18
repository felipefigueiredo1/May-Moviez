<?php

namespace App\Http\Controllers;

use Inertia\Inertia;
use Illuminate\Http\Request;
use App\Models\Post;

class DashboardController extends Controller
{
    public function index()
    {
        //$posts = Post::with('comments')->get();
        $posts = Post::where('user_id', '=', auth()->user()->id)->paginate(1);
        return Inertia::render('Dashboard', ['user' => auth()->user()->name, 'posts' => $posts]);
    }

    public function buscando(Request $request)
    {
        $posts = Post::where('name', 'like', '%'.$request->buscar.'%')->where('user_id', '=', auth()->user()->id)->paginate(1);

        return Inertia::render('Dashboard', ['user' => auth()->user()->name, 'posts' => $posts]);
    }
}
