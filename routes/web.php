<?php

use App\Http\Controllers\CommentLikeController;
use App\Http\Controllers\PostLikeController;
use Inertia\Inertia;
use Illuminate\Support\Facades\Route;
use Illuminate\Foundation\Application;
use App\Http\Controllers\PostController;
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

Route::get('/', function () {
    return Inertia::render('Welcome', [
        'canLogin' => Route::has('login'),
        'canRegister' => Route::has('register'),
        'laravelVersion' => Application::VERSION,
        'phpVersion' => PHP_VERSION,
    ]);
})->name('welcome');


Route::group(['prefix' => 'dashboard', 'middleware' => 'auth', 'verified'], function() {
    Route::get('/', [DashboardController::class, 'index'])->name('dashboard');
});

Route::get('/home', [PostController::class, 'index'])->name('home');

Route::group(['prefix' => 'post', 'middleware' => 'auth', 'verified'], function() {
    Route::post('/', [PostController::class, 'store'])->name('post.post');
    Route::get('/{id}', [PostController::class, 'show'])->name('post.show');
    Route::put('/{id}', [PostController::class, 'update'])->name('post.update');
    Route::delete('/{id}', [PostController::class, 'destroy'])->name('post.destroy');
});

Route::resource('comment', CommentController::class)->middleware(['auth', 'verified']);

Route::resource('commentLike', CommentLikeController::class)->middleware(['auth', 'verified']);
Route::resource('postLike', PostLikeController::class)->middleware(['auth', 'verified']);


require __DIR__.'/auth.php';
