<?php

namespace App\Http\Controllers;

use App\Models\PostLike;
use Illuminate\Http\Request;

class PostLikeController extends Controller
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
            PostLike::create($request->all());
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
            PostLike::findOrFail($id)->delete();
            return back();
        } catch(\Exception) {
            return back()->with("message", "Ocorreu algum erro ao tentar excluir o comentario, contate o administrador.");
        }
    }
}
