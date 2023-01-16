<?php

namespace App\Repository;
use App\Models\Post;

class PostRepository extends ModelRepositoryAbstract
{
    public object $model;

    public function __construct($model)
    {
        $this->model = $model;
    }
}
