<?php

namespace App\Http\Controllers;

use App\Models\CommentLike;
use Illuminate\Http\Request;

class CommentLikeController extends Controller
{
    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\RedirectResponse
     */
    public function store(Request $request)
    {
        try {
            CommentLike::create($request->all());
            return back();
        } catch(\Exception) {
            return back()->with("message", "Ocorreu algum erro ao tentar inserir o comentario, contate o administrador.");
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\RedirectResponse
     */
    public function destroy($id)
    {
        try {
            CommentLike::findOrFail($id)->delete();
            return back();
        } catch(\Exception) {
            return back()->with("message", "Ocorreu algum erro ao tentar excluir o comentario, contate o administrador.");
        }
    }
}
