<?php

namespace App\Http\Controllers;

use App\Models\Comment;
use App\Models\Like;
use App\Models\Post;
use App\Notifications\LikedCommentNotification;
use App\Notifications\LikedPostNotification;
use App\Notifications\PostLike;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class LikeController extends Controller
{
    public function likePost(Request $request)
    {
        $input = $request->all();

        Validator::make($input, [
            'likeableId' => ['required'],
        ])->validateWithBag('like');

        $post = Post::query()->findOrFail($input['likeableId']);

        $this->handleLike(Post::class, $post, $request->user());
        return back();
    }

    public function handleLike($type, $likeable, $user)
    {
        $existing_like = Like::withTrashed()->whereLikeableType($type)->whereLikeableId($likeable->id)->whereUserId($user->id)->first();

        if (is_null($existing_like)) {
            Like::create([
                'user_id' => $user->id,
                'likeable_id' => $likeable->id,
                'likeable_type' => $type,
            ]);

            if ($user->id != $likeable->user->id) {
                if ($type == Post::class) {
                    $likeable->user->notify(new LikedPostNotification($likeable, $user));
                } else if ($type == Comment::class) {
                    $likeable->user->notify(new LikedCommentNotification($likeable, $likeable->post, $user));
                }
            }

        } else {
            if (is_null($existing_like->deleted_at)) {
                $existing_like->delete();
            } else {
                $existing_like->restore();
            }
        }
    }

    public function likeComment(Request $request)
    {
        $input = $request->all();

        Validator::make($input, [
            'likeableId' => ['required'],
        ])->validateWithBag('like');

        $comment = Comment::query()->findOrFail($input['likeableId']);

        $this->handleLike(Comment::class, $comment, $request->user());
        return back();
    }
}
