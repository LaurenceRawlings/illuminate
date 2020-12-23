<?php

namespace App\Http\Controllers;

use App\Models\Comment;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Support\Facades\Validator;

class CommentController extends Controller
{
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

        if (isset($input['commentId'])) {

            $id = $input['commentId'];
            $comment = Comment::query()->findOrFail($id);

            if ($comment->user_id != $request->user()->id) {
                return Redirect::route('home');
            }

            $this->update($comment, $input);
            return back();
        }

        $request->user()->comments()->create([
            'post_id' => $input['postId'],
            'comment' => $input['comment'],
        ]);

        return back();
    }

    /**
     * Update the specified resource in storage.
     *
     * @param Comment $comment
     * @param array $input
     */
    public function update(Comment $comment, array $input)
    {
        $comment->forceFill([
            'comment' => $input['comment'],
        ])->save();
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
