<?php

namespace App\Http\Controllers;

use App\Helpers\InertiaPaginator;
use App\Models\Post;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Support\Facades\Validator;
use Inertia\Inertia;
use Mews\Purifier\Facades\Purifier;

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
            $post->user_photo = User::query()->find($post->user_id)->profile_photo_url;
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
     * @return \Illuminate\Http\RedirectResponse
     */
    public function store(Request $request)
    {
        $input = $request->all();

        Validator::make($input, [
            'thumbnail' => ['image', 'mimes:png,jpg,jpeg', 'max:4096', 'nullable'],
            'title' => ['required'],
            'description' => ['required'],
            'body' => ['required'],
        ])->validateWithBag('createPost');


        $thumbnail = $input['thumbnail'];

        if ($thumbnail) {
            $imageName = $thumbnail->store('post-thumbnails/'.$request->user()->id, 'public');
        }

        $body = Purifier::clean($input['body']);

        $request->user()->posts()->create([
            'thumbnail' => $thumbnail ? $imageName : null,
            'title' => $input['title'],
            'description' => $input['description'],
            'body' => $body
        ]);

        return Redirect::route('home');
    }

    /**
     * Display the specified resource.
     *
     */
    public function show(Request $request)
    {
        if (!$request->input('p')) {
            return Redirect::route('home');
        }

        $id = $request->input('p');

        $post = Post::query()->findOrFail($id);

        $post->forceFill([
            'views' => $post->views + 1,
        ])->save();

        $post->user_name = User::query()->find($post->user_id)->name;
        $post->user_photo = User::query()->find($post->user_id)->profile_photo_url;
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
