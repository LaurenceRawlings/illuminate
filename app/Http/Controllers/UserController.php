<?php

namespace App\Http\Controllers;

use App\Helpers\InertiaPaginator;
use App\Models\Post;
use App\Models\User;
use Inertia\Inertia;

class UserController extends Controller
{
    /**
     * Display the specified resource.
     *
     * @param int $id
     * @return \Inertia\Response
     */
    public function show($username)
    {
        $user = User::query()->where('username', '=', $username)->firstOrFail();

        $posts = $user->posts()->latest()->paginate(4);

        $paginatedLinks = InertiaPaginator::paginationLinks($posts);

        return Inertia::render('User/Show', [
            'profile' => $user->profile,
            'posts' => $posts,
            'paginated_links' => $paginatedLinks
        ]);
    }
}
