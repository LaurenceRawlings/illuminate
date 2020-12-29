<?php

namespace App\Http\Controllers;

use App\Helpers\InertiaPaginator;
use App\Models\Post;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Support\Facades\Validator;
use Illuminate\Validation\ValidationException;
use Inertia\Inertia;
use Inertia\Response;
use Mews\Purifier\Facades\Purifier;

class PostController extends Controller
{
    /**
     * Create the controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->authorizeResource(Post::class, 'post');
    }

    /**
     * Display a listing of the resource.
     *
     * @return Response
     */
    public function index(): Response
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
     * @return Response
     */
    public function create(): Response
    {
        return Inertia::render('Posts/Edit');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param Request $request
     * @return RedirectResponse
     * @throws ValidationException
     */
    public function store(Request $request): RedirectResponse
    {
        $input = $request->all();

        Validator::make($input, [
            'thumbnail' => ['image', 'mimes:png,jpg,jpeg,gif', 'max:8192', 'nullable'],
            'title' => ['required', 'max:150'],
            'description' => ['required', 'max:255'],
            'body' => ['required', 'max:20000'],
        ])->validateWithBag('createPost');


        if (isset($input['thumbnail'])) {
            $imageName = $input['thumbnail']->store('post-thumbnails/' . $request->user()->id, 'public');
        } else {
            $imageName = null;
        }

        $body = Purifier::clean($input['body'], 'youtube');

        $post = $request->user()->posts()->create([
            'thumbnail' => $imageName,
            'title' => $input['title'],
            'description' => $input['description'],
            'body' => $body
        ]);

        return Redirect::route('posts.show', [$post]);
    }

    /**
     * Display the specified resource.
     *
     * @param Post $post
     * @return Response
     */
    public function show(Post $post)
    {
        $post->views = $post->views + 1;
        $post->timestamps = false;
        $post->save();

        $comments = $post->comments->all();

        return Inertia::render('Posts/Show', [
            'post' => $post,
            'comments' => $comments
        ]);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param Post $post
     * @return Response
     */
    public function edit(Post $post)
    {
        return Inertia::render('Posts/Edit', [
            'post' => $post,
        ]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param Request $request
     * @param Post $post
     * @return RedirectResponse
     */
    public function update(Request $request, Post $post)
    {
        $input = $request->all();

        Validator::make($input, [
            'thumbnail' => ['image', 'mimes:png,jpg,jpeg,gif', 'max:8192', 'nullable'],
            'title' => ['required'],
            'description' => ['required'],
            'body' => ['required'],
            'remove_thumbnail' => ['boolean']
        ])->validateWithBag('createPost');

        if (isset($input['thumbnail'])) {
            $imageName = $input['thumbnail']->store('post-thumbnails/' . $request->user()->id, 'public');
        } else {
            if (isset($input['remove_thumbnail']) && $input['remove_thumbnail']) {
                $imageName = null;
            } else {
                $imageName = $post->thumbnail;
            }
        }

        $body = Purifier::clean($input['body'], 'youtube');

        if ($input['thumbnail'] != $post->thumbnail || $input['title'] != $post->title ||
            $input['description'] != $post->description || $input['body'] != $post->body) {
            $post->timestamps = true;

            $post->forceFill([
                'thumbnail' => $imageName,
                'title' => $input['title'],
                'description' => $input['description'],
                'body' => $body
            ])->save();
        }

        return Redirect::route('posts.show', [$post]);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param Post $post
     * @return \Illuminate\Http\Response
     */
    public function destroy(Post $post)
    {
        //
    }
}
