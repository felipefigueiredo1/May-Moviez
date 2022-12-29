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

    public function index(Request $request)
    {
        $search = '';
        if($request->buscar) {
            $posts = $this->postRepository->search($request, 6, true);
            $search = $request->buscar;
        } else {
            $posts = $this->postRepository->get(6,true);
        }

        return Inertia::render('Dashboard', ['user' => auth()->user()->name,'userId' => auth()->user()->id, 'posts' => $posts,
        'search' => $search]);
    }
}
