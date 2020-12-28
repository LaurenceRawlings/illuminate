<?php

namespace App\Http\Controllers;

use App\Models\Comment;
use App\Models\Post;
use App\Notifications\CommentedPostNotification;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Support\Facades\Validator;

class CommentController extends Controller
{
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
            'postId' => ['required'],
            'comment' => ['required', 'string', 'max:255'],
        ])->validateWithBag(isset($input['commentId']) ? 'updateComment' : 'addComment');

        $post = Post::query()->findOrFail($input['postId']);

        if (isset($input['commentId'])) {
            $comment = Comment::query()->findOrFail($input['commentId']);

            if ($comment->user_id != $request->user()->id) {
                return Redirect::route('home');
            }

            $this->update($comment, $input);
            return back();
        }

        $comment = $request->user()->comments()->create([
            'post_id' => $post->id,
            'comment' => $input['comment'],
        ]);

        if ($request->user()->id != $post->user->id) {
            $post->user->notify(new CommentedPostNotification($comment, $post, $request->user()));
        }

        return back();
    }

    /**
     * Update the specified resource in storage.
     *
     * @param $comment
     * @param array $input
     */
    public function update($comment, array $input)
    {
        $comment->forceFill([
            'comment' => $input['comment'],
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
