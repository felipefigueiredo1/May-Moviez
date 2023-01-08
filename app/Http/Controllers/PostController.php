<?php

namespace App\Http\Controllers;

use App\Models\Comment;
use App\Repository\PostRepository;
use Illuminate\Database\Eloquent\ModelNotFoundException;
use Illuminate\Support\Facades\Redirect;
use Inertia\Inertia;
use Illuminate\Http\Request;
use App\Models\Post;

class PostController extends Controller
{
    public object $post;

    public object $postRepository;

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

        return Inertia::render('Home', ['user' => auth()->user()->name,'userId' => auth()->user()->id, 'posts' => $posts,
            'search' => $search]);
    }

    public function store(Request $request): \Illuminate\Http\RedirectResponse
    {
        $rules = [
            'name' => 'required',
            'body' => 'required',
            'rating' => 'required',
        ];
        $feedback = [
            'name.required' => 'O campo titulo não pode ser vazio!',
            'name.body' => 'O campo descrição não pode ser vazio!',
            'name.rating' => 'O campo nota não pode ser vazio!',
        ];
        $request->validate($rules, $feedback);
        try {
            Post::create([
                'name' => $request->name,
                'user_id' => $request->user_id,
                'body' => $request->body,
                'rating' => $request->rating
            ]);

            return back()->with("message", "Publicado com sucesso!");
        } catch(\Throwable $th) {
            return back()->with("message", "Ocorreu algum erro contate o administrador.");
        }
    }

    public function show($id)
    {
        try {
            $user = auth()->user()->id;
            $post = Post::with('comments')->with('postLikes')->findOrFail($id);
            $comments = $post->comments()->with('user')->with('commentLikes')->paginate(5);

            return Inertia::render('Post/Show', ['post' => $post, 'user' => $user, 'comments' => $comments]);;
        } catch(ModelNotFoundException) {
            abort(403);
        }
    }

    public function update($id, Request $request)
    {
        try {
            $post = Post::findOrFail($id);
            $rules = [
                'name' => 'required',
                'body' => 'required',
                'rating' => 'required',
            ];
            $feedback = [
                'name.required' => 'O campo titulo não pode ser vazio!',
                'name.body' => 'O campo descrição não pode ser vazio!',
                'name.rating' => 'O campo nota não pode ser vazio!',
            ];
            $request->validate($rules, $feedback);
            $post->fill($request->all());
            $post->save();
            return back()->with("message", "Editado com sucesso!");
        } catch(\Exception) {
            return redirect()->back()->with("message", "Não foi possivel editar essa publicação.");
        }

    }

    public function destroy($id): \Illuminate\Http\RedirectResponse
    {
        try{
            Post::destroy($id);
            return back()->with("message", "Excluido com sucesso!");
        } catch(\Throwable $th) {
            return redirect()->back()->with("message", "Não foi possivel excluir essa publicação.");
        }
    }



}
