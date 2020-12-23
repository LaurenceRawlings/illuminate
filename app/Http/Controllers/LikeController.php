<?php

namespace App\Http\Controllers;

use App\Models\Comment;
use App\Models\Like;
use App\Models\Post;
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

        Post::query()->findOrFail($input['likeableId']);
        $this->handleLike(Post::class, $input['likeableId'], $request->user());
        return back();
    }

    public function likeComment(Request $request)
    {
        $input = $request->all();

        Validator::make($input, [
            'likeableId' => ['required'],
        ])->validateWithBag('like');

        Comment::query()->findOrFail($input['likeableId']);
        $this->handleLike(Comment::class, $input['likeableId'], $request->user());
        return back();
    }

    public function handleLike($type, $id, $user)
    {
        $existing_like = Like::withTrashed()->whereLikeableType($type)->whereLikeableId($id)->whereUserId($user->id)->first();

        if (is_null($existing_like)) {
            Like::create([
                'user_id'       => $user->id,
                'likeable_id'   => $id,
                'likeable_type' => $type,
            ]);
        } else {
            if (is_null($existing_like->deleted_at)) {
                $existing_like->delete();
            } else {
                $existing_like->restore();
            }
        }
    }
}
