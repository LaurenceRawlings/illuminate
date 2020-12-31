<?php

namespace App\Http\Controllers;

use App\Models\Comment;
use App\Models\Like;
use App\Models\Post;
use App\Notifications\LikedCommentNotification;
use App\Notifications\LikedPostNotification;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use Illuminate\Validation\ValidationException;

class LikeController extends Controller
{
    /**
     * @param Request $request
     * @return RedirectResponse
     * @throws ValidationException
     */
    public function likePost(Request $request): RedirectResponse
    {
        $input = $request->all();

        Validator::make($input, [
            'likeableId' => ['required'],
        ])->validateWithBag('like');

        $post = Post::query()->findOrFail($input['likeableId']);

        $liked = $this->handleLike(Post::class, $post, $request->user());

        if ($liked) {
            return back()->with('message', 'Post liked!')->with('colour', 'blue-500');
        }

        return back();
    }

    private function handleLike($type, $likeable, $user): bool
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
                return false;
            } else {
                $existing_like->restore();
            }
        }

        return true;
    }

    /**
     * @param Request $request
     * @return RedirectResponse
     * @throws ValidationException
     */
    public function likeComment(Request $request): RedirectResponse
    {
        $input = $request->all();

        Validator::make($input, [
            'likeableId' => ['required'],
        ])->validateWithBag('like');

        $comment = Comment::query()->findOrFail($input['likeableId']);

        $liked = $this->handleLike(Comment::class, $comment, $request->user());

        if ($liked) {
            return back()->with('message', 'Comment liked!')->with('colour', 'blue-500');
        }

        return back();
    }
}
