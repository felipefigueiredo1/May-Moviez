<?php

namespace App\Http\Controllers;

use App\Models\Comment;
use Illuminate\Database\Eloquent\ModelNotFoundException;
use Illuminate\Support\Facades\Redirect;
use Inertia\Inertia;
use Illuminate\Http\Request;
use App\Models\Post;

class PostController extends Controller
{
    public object $post;

    public function __construct(Post $post)
    {
        $this->post = $post;
    }

    public function index(): \Illuminate\Database\Eloquent\Collection
    {
        return $this->post->all();
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

            return Redirect::route('dashboard')->with("message", "Publicado com sucesso!");
        } catch(\Throwable $th) {
            return Redirect::route('dashboard')->with("message", "Ocorreu algum erro contate o administrador.");
        }
    }

    public function show($id)
    {
        try {
            $user = auth()->user()->id;
            $post = Post::with('comments')->findOrFail($id);
            $comments = $post->comments()->with('user')->with('commentLikes')->paginate(5);

            return Inertia::render('PostPage', ['post' => $post, 'user' => $user, 'comments' => $comments]);;
        } catch(ModelNotFoundException) {
            abort(403);
        }
    }

    public function update($id, Request $request)
    {
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
        return Redirect::route('dashboard')->with("message", "Editado com sucesso!");
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
