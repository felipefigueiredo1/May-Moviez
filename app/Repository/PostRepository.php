<?php

namespace App\Repository;
use App\Models\Post;
use Illuminate\Pagination\LengthAwarePaginator;

class PostRepository implements PostInterface
{
    public object $post;

    public function __construct(Post $post)
    {
        $this->post = $post;
    }

    public function get($userMoviez = null): LengthAwarePaginator
    {
        if($userMoviez)
            return $this->post->where('user_id', '=', auth()->user()->id)->paginate(5);

        return $this->post->paginate(5);
    }

    public function search($request, $userMoviez = null): LengthAwarePaginator
    {
        if($userMoviez)
            return $this->post->where('name', 'like', '%'.$request->buscar.'%')->where('user_id', '=', auth()->user()->id)->paginate(5);

        return $this->post->where('name', 'like', '%'.$request->buscar.'%')->paginate(5);
    }
}
