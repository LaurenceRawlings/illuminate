<?php


namespace App\Traits;


use App\Helpers\Utils;
use App\Models\User;
use Illuminate\Support\Facades\Auth;

trait Likeable
{
    public function getIsLikedAttribute()
    {
        $like = $this->likes()->whereUserId(Auth::id())->first();
        return !is_null($like);
    }

    public function likes()
    {
        return $this->morphToMany(User::class, 'likeable')->whereDeletedAt(null);
    }

    public function getLikesAttribute()
    {
        return Utils::formatCount($this->likes()->count());
    }
}
