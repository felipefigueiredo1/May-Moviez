<?php

namespace App\Repository;

interface ModelRepositoryInterface
{
    public function get();
    public function search($request);
}

