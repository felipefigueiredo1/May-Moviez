<?php

namespace App\Repository;

use Illuminate\Pagination\LengthAwarePaginator;

abstract class ModelRepositoryAbstract implements ModelRepositoryInterface
{
    public function get($user = null): LengthAwarePaginator
    {
        if($user)
            return $this->model->where('user_id', '=', auth()->user()->id)->paginate(5);

        return $this->model->paginate(5);
    }

    public function search($request, $user = null): LengthAwarePaginator
    {
        if($user)
            return $this->model->where('name', 'like', '%'.$request->buscar.'%')->where('user_id', '=', auth()->user()->id)->paginate(5);

        return $this->model->where('name', 'like', '%'.$request->buscar.'%')->paginate(5);
    }
}
