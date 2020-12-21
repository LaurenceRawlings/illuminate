<?php

namespace App\Http\Controllers;

use App\Models\Post;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Support\Facades\Validator;
use Inertia\Inertia;
use Mews\Purifier\Facades\Purifier;
use Response;

class CommentController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @param Request $request
     */
    public function index(Request $request)
    {
        if (!$request->input('p')) {
            return Response::make("Bad Request", 400);
        }

        $id = $request->input('p');

        $post = Post::query()->findOrFail($id);
        $comments = $post->comments->all();

        return Response::json([
            'comments' => $comments,
        ]);
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
            'postId' => ['required'],
            'comment' => ['required', 'string', 'max:255'],
        ])->validateWithBag('addComment');


        $request->user()->comments()->create([
            'post_id' => $input['postId'],
            'comment' => $input['comment'],
        ]);

        return back();
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
