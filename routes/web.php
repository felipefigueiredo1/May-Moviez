<?php

use Illuminate\Http\Request;
use Inertia\Inertia;
use Illuminate\Support\Facades\Route;
use Illuminate\Foundation\Application;
use App\Http\Controllers\PostController;
use App\Http\Controllers\TesteController;
use App\Http\Controllers\MoviezController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\CommentController;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::get('/home', function () {
   return Inertia::render('Home', [
       'title' => 'Olá do servidor!'
   ]);
});

Route::get('/lg', function() {
   return Inertia::render('Lg');
});

Route::post('/lg', function(Request $request) {
    $request->validate([
        'email' => ['required', 'email'],
        'password' => ['required'],
    ]);

    return redirect('/dashboard');
});

Route::get('/', function () {
    return Inertia::render('Welcome', [
        'canLogin' => Route::has('login'),
        'canRegister' => Route::has('register'),
        'laravelVersion' => Application::VERSION,
        'phpVersion' => PHP_VERSION,
    ]);
})->name('welcome');

Route::get('/moviez', [MoviezController::class, 'index'])->middleware(['auth', 'verified'])->name('moviez');
Route::post('/moviez', [MoviezController::class, 'store'])->middleware(['auth', 'verified'])->name('moviez.post');


Route::get('/dashboard', [DashboardController::class, 'index'])->middleware(['auth', 'verified'])->name('dashboard');

Route::group(['prefix' => 'post', 'middleware' => 'auth', 'verified'], function() {
    Route::get('/', [PostController::class, 'index'])->name('post');
    Route::post('/', [PostController::class, 'store'])->name('post.post');
    Route::get('/{id}', [PostController::class, 'show'])->name('post.show');
});


//Route::post('/comment', [CommentController::class, 'store'])->middleware(['auth', 'verified'])->name('comment.post');
Route::resource('comment', CommentController::class)->middleware(['auth', 'verified']);

Route::get('/teste', [TesteController::class, 'index'])->name('teste');

require __DIR__.'/auth.php';
