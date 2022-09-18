<?php

namespace App\Http\Controllers;

use App\Models\Post;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Redirect;
use Inertia\Inertia;

class MoviezController extends Controller
{
    public function index()
    {
        $posts = Post::paginate(1);
        return Inertia::render('Moviez', ['posts' => $posts]);
    }

    public function store(Request $request)
    {
        return Inertia::render('Moviez');
    }

    public function buscando(Request $request)
    {
        $posts = Post::where('name', 'like', '%'.$request->buscar.'%')->paginate(1);

        return Inertia::render('Moviez', ['posts' => $posts]);
    }
}
