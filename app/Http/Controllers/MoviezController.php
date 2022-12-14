<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Redirect;
use App\Repository\PostRepository;
use Inertia\Inertia;

class MoviezController extends Controller
{
    public object $postRepository;

    public function __construct(PostRepository $postRepository)
    {
        $this->postRepository = $postRepository;
    }

    public function index()
    {
        $posts = $this->postRepository->get(6);
        return Inertia::render('Moviez', ['posts' => $posts]);
    }

    public function store(Request $request)
    {
        return Inertia::render('Moviez');
    }

    public function buscando(Request $request)
    {
        $posts = $this->postRepository->search($request, 6);

        return Inertia::render('Moviez', ['posts' => $posts]);
    }
}
