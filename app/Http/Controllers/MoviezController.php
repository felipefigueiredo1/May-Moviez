<?php

namespace App\Http\Controllers;

use Inertia\Inertia;
use Illuminate\Http\Request;

class MoviezController extends Controller
{
    public function index()
    {
        return Inertia::render('Moviez', ['hey' => 'focker']);
    }
}
