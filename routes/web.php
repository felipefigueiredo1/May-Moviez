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

Route::get('/', function () {
    return Inertia::render('Welcome', [
        'canLogin' => Route::has('login'),
        'canRegister' => Route::has('register'),
        'laravelVersion' => Application::VERSION,
        'phpVersion' => PHP_VERSION,
    ]);
})->name('welcome');

Route::group(['prefix' => 'moviez', 'middleware' => 'auth', 'verified'], function() {
    Route::get('/', [MoviezController::class, 'index'])->name('moviez');
});

Route::group(['prefix' => 'dashboard', 'middleware' => 'auth', 'verified'], function() {
    Route::get('/', [DashboardController::class, 'index'])->name('dashboard');
});



Route::group(['prefix' => 'post', 'middleware' => 'auth', 'verified'], function() {
    Route::get('/', [PostController::class, 'index'])->name('post');
    Route::post('/', [PostController::class, 'store'])->name('post.post');
    Route::get('/{id}', [PostController::class, 'show'])->name('post.show');
//    Route::get('/{id}', [PostController::class, 'edit'])->name('post.edit');
    Route::put('/{id}', [PostController::class, 'update'])->name('post.update');
    Route::delete('/{id}', [PostController::class, 'destroy'])->name('post.destroy');
});

Route::resource('comment', CommentController::class)->middleware(['auth', 'verified']);

require __DIR__.'/auth.php';
