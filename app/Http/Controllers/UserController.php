<?php

namespace App\Http\Controllers;

use App\Helpers\InertiaPaginator;
use App\Models\User;
use Illuminate\Database\Eloquent\ModelNotFoundException;
use Illuminate\Http\Request;
use Inertia\Inertia;
use Inertia\Response;

class UserController extends Controller
{
    /**
     * Display the specified resource.
     *
     * @param Request $request
     * @param $username
     * @return array|Response
     * @throws ModelNotFoundException
     */
    public function show(Request $request, $username)
    {
        if ($request->wantsJson()) {
            return [
                'bio' => $request->user()->profile->bio,
                'status_text' => $request->user()->profile->status_text,
                'status_emoji' => $request->user()->profile->status_emoji
            ];
        }

        $user = User::query()->where('username', $username)->firstOrFail();

        $posts = $user->posts()->latest()->paginate(4);

        $paginatedLinks = InertiaPaginator::paginationLinks($posts);

        return Inertia::render('User/Show', [
            'profile' => $user->profile,
            'posts' => $posts,
            'paginated_links' => $paginatedLinks
        ]);
    }
}
