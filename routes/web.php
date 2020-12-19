<?php

use App\Http\Controllers\NewsPostController;
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

Route::get('/', [PostController::class, 'index'])->name('posts');
Route::middleware(['auth:sanctum', 'verified'])->get('/write', [PostController::class, 'create'])->name('posts.create');
Route::middleware(['auth:sanctum', 'verified'])->post('/write', [PostController::class, 'store'])->name('posts.store');


Route::get('/posts/{post}', [PostController::class, 'show'])->name('posts.show');

Route::get('/user/{user}', [UserController::class, 'show'])->name('user.show');

Route::get('/news', [NewsPostController::class, 'index'])->name('news');

Route::get('/news', [NewsPostController::class, 'index'])->name('news');


Route::middleware(['auth:sanctum', 'verified'])->get('/dashboard', function () {
    return Inertia\Inertia::render('Dashboard');
})->name('dashboard');

