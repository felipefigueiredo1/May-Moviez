<?php

namespace App\Http\Controllers;

use Inertia\Inertia;
use Illuminate\Http\Request;
use App\Models\Post;

class DashboardController extends Controller
{
    public function index()
    {
        $posts = Post::with('comments')->get();
        return Inertia::render('Dashboard', ['user' => auth()->user()->name, 'posts' => $posts]);
    }
}
