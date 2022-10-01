<?php

use Inertia\Inertia;
use Illuminate\Support\Facades\Route;
use Illuminate\Foundation\Application;
use App\Http\Controllers\PostController;
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
Route::get('/moviez/buscando', [MoviezController::class, 'index'])->middleware(['auth', 'verified'])->name('moviez');
Route::post('/moviez/buscando', [MoviezController::class, 'buscando'])->name('post.buscando');


Route::get('/dashboard', [DashboardController::class, 'index'])->middleware(['auth', 'verified'])->name('dashboard');
Route::post('/dashboard/buscando', [DashboardController::class, 'buscando'])->middleware(['auth', 'verified'])->name('dashboard.buscando');
Route::get('/dashboard/buscando', [DashboardController::class, 'index'])->middleware(['auth', 'verified'])->name('dashboard');


Route::group(['prefix' => 'post', 'middleware' => 'auth', 'verified'], function() {
    Route::get('/', [PostController::class, 'index'])->name('post');
    Route::post('/', [PostController::class, 'store'])->name('post.post');
    Route::get('/{id}', [PostController::class, 'show'])->name('post.show');
    Route::delete('/{id}', [PostController::class, 'destroy'])->name('post.destroy');
});


//Route::post('/comment', [CommentController::class, 'store'])->middleware(['auth', 'verified'])->name('comment.post');
Route::resource('comment', CommentController::class)->middleware(['auth', 'verified']);

require __DIR__.'/auth.php';
