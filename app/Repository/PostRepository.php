<?php

namespace App\Repository;
use App\Models\Post;

class PostRepository extends ModelRepositoryAbstract
{
    protected object $model;

    public function __construct(Post $post)
    {
        $this->model = $post;
    }
}
