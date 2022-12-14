<?php

namespace App\Http\Controllers;

use Inertia\Inertia;
use Illuminate\Http\Request;
use App\Repository\PostRepository;

class DashboardController extends Controller
{
    public $postRepository;

    public function __construct(PostRepository $postRepository)
    {
        $this->postRepository = $postRepository;
    }

    public function index()
    {
        $posts = $this->postRepository->get(true);
        return Inertia::render('Dashboard', ['user' => auth()->user()->name,'userId' => auth()->user()->id, 'posts' => $posts]);
    }

    public function buscando(Request $request)
    {
        $posts = $this->postRepository->search($request, true);
        return Inertia::render('Dashboard', ['user' => auth()->user()->name, 'posts' => $posts]);
    }
}
