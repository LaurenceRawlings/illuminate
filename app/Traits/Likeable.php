<?php


namespace App\Traits;


use App\Helpers\Utils;
use App\Models\User;
use Illuminate\Support\Facades\Auth;

trait Likeable
{
    public function getIsLikedAttribute(): bool
    {
        return !is_null($this->likes()->whereUserId(Auth::id())->first());
    }

    public function likes()
    {
        return $this->morphToMany(User::class, 'likeable')->whereDeletedAt(null);
    }

    public function getLikesAttribute(): string
    {
        return Utils::formatCount($this->likes()->count());
    }
}
