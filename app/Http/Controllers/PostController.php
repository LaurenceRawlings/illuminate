<?php

namespace App\Http\Controllers;

use App\Helpers\InertiaPaginator;
use App\Models\Post;
use App\Models\User;
use Illuminate\Http\Request;
use Inertia\Inertia;

class PostController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Inertia\Response
     */
    public function index()
    {
        $posts = Post::query()->orderByDesc('created_at')->paginate(12);

        foreach ($posts as $post) {
            $post->user_name = User::query()->find($post->user_id)->name;
            $post->user_photo = User::query()->find($post->user_id)->profile_photo_path;
            $post->published = $post->created_at->diffForHumans();
        }

        $paginatedLinks = InertiaPaginator::paginationLinks($posts);

        return Inertia::render('Posts/Index', [
            'posts' => $posts,
            'paginated_links' => $paginatedLinks
        ]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Inertia\Response
     */
    public function create()
    {
        return Inertia::render('Posts/Edit', []);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Inertia\Response
     */
    public function show($id)
    {
        $post = Post::query()->findOrFail($id);

        $post->user_name = User::query()->find($post->user_id)->name;
        $post->user_photo = User::query()->find($post->user_id)->profile_photo_path;
        $post->published = $post->created_at->diffForHumans();

        return Inertia::render('Posts/Show', [
            'post' => $post,
        ]);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
}
