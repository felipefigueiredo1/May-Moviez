<?php

namespace App\Repository;

interface ModelRepositoryInterface
{
    public function get($perPage);
    public function search($request, $perPage);
}

