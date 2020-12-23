<?php

namespace App\Http\Controllers;

use App\Helpers\InertiaPaginator;
use App\Models\Post;
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
        $posts = Post::query()->latest()->paginate(12);

        $paginatedLinks = InertiaPaginator::paginationLinks($posts);

        return Inertia::render('Posts/Index', [
            'posts' => $posts,
            'paginated_links' => $paginatedLinks
        ]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @param Request $request
     * @throws \Illuminate\Database\Eloquent\ModelNotFoundException
     */
    public function create(Request $request)
    {
        if (!$request->input('p')) {
            return Inertia::render('Posts/Edit');
        }

        $id = $request->input('p');

        $post = Post::query()->findOrFail($id);

        if ($request->user()->id != $post->user_id) {
            return Redirect::route('home');
        }

        return Inertia::render('Posts/Edit', [
            'post' => $post,
        ]);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param \Illuminate\Http\Request $request
     * @return \Illuminate\Http\RedirectResponse
     */
    public function store(Request $request)
    {
        $input = $request->all();

        Validator::make($input, [
            'thumbnail' => ['image', 'mimes:png,jpg,jpeg,gif', 'max:8192', 'nullable'],
            'title' => ['required'],
            'description' => ['required'],
            'body' => ['required'],
        ])->validateWithBag('createPost');


        if (isset($input['thumbnail'])) {
            $imageName = $input['thumbnail']->store('post-thumbnails/' . $request->user()->id, 'public');
        } else {
            $imageName = null;
        }

        $body = Purifier::clean($input['body'], 'youtube');

        if (isset($input['postId'])) {
            $id = $input['postId'];
            $post = Post::query()->findOrFail($id);

            if ($post->user_id != $request->user()->id) {
                return Redirect::route('home');
            }

            $input['body'] = $body;
            $input['thumbnail'] = $imageName;
            $this->update($post, $input);
            return Redirect::route('read', ['p' => $id]);
        }

        $request->user()->posts()->create([
            'thumbnail' => $imageName,
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

        $comments = $post->comments->all();

        return Inertia::render('Posts/Show', [
            'post' => $post,
            'comments' => $comments
        ]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param Post $post
     * @param array $input
     */
    public function update(Post $post, array $input)
    {
        $thumbnail = $input['thumbnail'] ? $input['thumbnail'] : $post->thumbnail;

        $post->forceFill([
            'thumbnail' => $thumbnail,
            'title' => $input['title'],
            'description' => $input['description'],
            'body' => $input['body']
        ])->save();
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param int $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
}
