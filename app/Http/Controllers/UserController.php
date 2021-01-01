<?php

namespace App\Http\Controllers;

use App\Helpers\InertiaPaginator;
use App\Models\User;
use Illuminate\Database\Eloquent\ModelNotFoundException;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Gate;
use Illuminate\Support\Facades\Redirect;
use Inertia\Inertia;
use Inertia\Response;
use Laravel\Jetstream\Contracts\DeletesUsers;

class UserController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return RedirectResponse|Response
     */
    public function index()
    {
        if (!Gate::allows('view-users')) {
            return Redirect::route('posts.index');
        }

        $users = User::query()->latest()->paginate(12);

        $paginatedLinks = InertiaPaginator::paginationLinks($users);

        return Inertia::render('Users/Index', [
            'users' => $users,
            'paginated_links' => $paginatedLinks
        ]);
    }

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
        $user = User::query()->where('username', $username)->firstOrFail();

        $posts = $user->posts()->latest()->paginate(4);

        $paginatedLinks = InertiaPaginator::paginationLinks($posts);

        return Inertia::render('Users/Show', [
            'profile' => $user->profile,
            'posts' => $posts,
            'paginated_links' => $paginatedLinks
        ]);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param User $user
     * @param DeletesUsers $deletesUsers
     * @return RedirectResponse
     */
    public function destroy(User $user, DeletesUsers $deletesUsers): RedirectResponse
    {
        Gate::authorize('destroy-users');

        $deletesUsers->delete($user);

        return back()->with('message', 'User deleted')->with('colour', 'red-500');
    }
}
