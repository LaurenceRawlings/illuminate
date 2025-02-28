<?php

namespace App\Http\Controllers;

use App\Models\Comment;
use App\Models\Post;
use App\Notifications\CommentedPostNotification;
use Exception;
use Illuminate\Database\Eloquent\ModelNotFoundException;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use Illuminate\Validation\ValidationException;

class CommentController extends Controller
{
    /**
     * Create the controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->authorizeResource(Comment::class, 'comment');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param Request $request
     * @return RedirectResponse
     * @throws ValidationException|ModelNotFoundException
     */
    public function store(Request $request): RedirectResponse
    {
        $input = $request->all();

        Validator::make($input, [
            'postId' => ['required'],
            'comment' => ['required', 'string', 'max:255'],
        ])->validateWithBag('addComment');

        $post = Post::query()->findOrFail($input['postId']);

        $comment = $request->user()->comments()->create([
            'post_id' => $post->id,
            'comment' => $input['comment'],
        ]);

        $notification = new CommentedPostNotification($comment, $post, $request->user());

        $post->notify($notification);

        if ($request->user()->id != $post->user->id) {
            $post->user->notify($notification);
        }

        return back()->with('message', 'Comment added!')->with('colour', 'blue-500');
    }

    /**
     * Update the specified resource in storage.
     *
     * @param Request $request
     * @param Comment $comment
     * @return RedirectResponse
     * @throws ValidationException
     */
    public function update(Request $request, Comment $comment): RedirectResponse
    {
        $input = $request->all();

        Validator::make($input, [
            'commentId' => ['required'],
            'comment' => ['required', 'string', 'max:255'],
        ])->validateWithBag('updateComment');

        $comment->forceFill([
            'comment' => $input['comment'],
        ])->save();

        return back()->with('message', 'Comment updated!')->with('colour', 'blue-500');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param Comment $comment
     * @return RedirectResponse
     * @throws Exception
     */
    public function destroy(Comment $comment): RedirectResponse
    {
        $comment->delete();
        return back()->with('message', 'Comment deleted')->with('colour', 'red-500');
    }
}
