<?php

namespace App\Http\Controllers;

use App\Models\User;
use Inertia\Inertia;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class TesteController extends Controller
{
    public function index()
    {
        $collection = collect([1, 2, 3, 4, 5])->implode('-');
        $users = User::where('id', 1)->get();
        //dd($users);
        return Inertia::render('Teste', [
            'felipe' => $users,
            'collection' => $collection
        ]);
    }
}
