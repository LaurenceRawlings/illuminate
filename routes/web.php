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

Route::any('/', function () {
    return Redirect::route('posts.index');
})->name('home');

Route::resource('posts', PostController::class);

Route::resource('comments', CommentController::class)->only([
    'store', 'update', 'destroy'
]);

Route::get('user/{username}', [UserController::class, 'show'])->name('user.show');
Route::get('news', [NewsPostController::class, 'index'])->name('news.index');

Route::middleware(['auth:sanctum', 'verified'])->group(function () {
    Route::post('like/post', [LikeController::class, 'likePost'])->name('like.store.post');
    Route::post('like/comment', [LikeController::class, 'likeComment'])->name('like.store.comment');
    Route::get('notifications', [NotificationController::class, 'index'])->name('notifications.index');
});
