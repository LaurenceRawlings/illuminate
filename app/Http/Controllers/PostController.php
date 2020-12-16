<?php

namespace App\Http\Controllers;

use App\Helpers\InertiaPaginator;
use App\Models\Post;
use App\Models\User;
use Illuminate\Http\Request;
use Inertia\Inertia;

class PostController extends Controller
{
    public function index()
    {
        $posts = Post::query()->orderByDesc('created_at')->paginate(12);

        foreach ($posts as $post) {
            $post->user_name = User::find($post->user_id)->name;
            $post->user_photo = User::find($post->user_id)->profile_photo_path;
        }

        $paginatedLinks = InertiaPaginator::paginationLinks($posts);

        return Inertia::render('Posts/Index', [
            'posts' => $posts,
            'paginated_links' => $paginatedLinks
        ]);
    }
}
