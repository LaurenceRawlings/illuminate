<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Inertia\Inertia;

class PostController extends Controller
{
    public function index()
    {
        $posts = DB::table('posts')->orderBy('created_at', 'desc')->paginate(20)->items();

        return Inertia::render('Posts', [
            'posts' => $posts
        ]);
    }
}
