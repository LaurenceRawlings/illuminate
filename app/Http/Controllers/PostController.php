<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Inertia\Inertia;

class PostController extends Controller
{
    public function index()
    {
        $posts = DB::table('posts')->orderBy('created_at', 'desc')->paginate(20)->items();

        foreach ($posts as $post) {
            $post->user_name = User::find($post->user_id)->name;
            $post->user_photo = User::find($post->user_id)->profile_photo_path;
        }

        return Inertia::render('Posts', [
            'posts' => $posts
        ]);
    }
}
