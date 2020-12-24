<?php

use App\Http\Controllers\CommentController;
use App\Http\Controllers\LikeController;
use App\Http\Controllers\NewsPostController;
use App\Http\Controllers\NotificationController;
use App\Http\Controllers\PostController;
use App\Http\Controllers\UserController;
use Illuminate\Support\Facades\Route;

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

//Route::get('/', function () {
//    return view('welcome');
//});

Route::middleware(['auth:sanctum', 'verified'])->group(function () {
    Route::get('/write', [PostController::class, 'create'])->name('post.create');
    Route::post('/write', [PostController::class, 'store'])->name('post.store');
    Route::post('/comment', [CommentController::class, 'store'])->name('comment.store');
    Route::post('/like/post', [LikeController::class, 'likePost'])->name('like.post');
    Route::post('/like/comment', [LikeController::class, 'likeComment'])->name('like.comment');
    Route::get('/notifications', [NotificationController::class, 'index'])->name('notifications');
    Route::get('/dashboard', function () {
        return Inertia\Inertia::render('Dashboard');
    })->name('dashboard');
});

Route::get('/', [PostController::class, 'index'])->name('home');
Route::get('/read', [PostController::class, 'show'])->name('read');
Route::get('/news', [NewsPostController::class, 'index'])->name('news');
Route::get('/{username}', [UserController::class, 'show'])->name('user.show');
