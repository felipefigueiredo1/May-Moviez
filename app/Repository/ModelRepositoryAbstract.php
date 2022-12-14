<?php

namespace App\Repository;

use Illuminate\Pagination\LengthAwarePaginator;

abstract class ModelRepositoryAbstract implements ModelRepositoryInterface
{
    public function get($perPage, $user = null): LengthAwarePaginator
    {
        if($user)
            return $this->model->where('user_id', '=', auth()->user()->id)->paginate($perPage);

        return $this->model->paginate($perPage);
    }

    public function search($request, $perPage, $user = null): LengthAwarePaginator
    {
        if($user)
            return $this->model->where('name', 'like', '%'.$request->buscar.'%')->where('user_id', '=', auth()->user()->id)->paginate($perPage);

        return $this->model->where('name', 'like', '%'.$request->buscar.'%')->paginate($perPage);
    }
}
