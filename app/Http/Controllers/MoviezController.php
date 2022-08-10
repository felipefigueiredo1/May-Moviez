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
        $posts = Post::get();
        return Inertia::render('Moviez', ['posts' => $posts]);
    }

    public function store(Request $request)
    {
        return Inertia::render('Moviez');
    }
}
