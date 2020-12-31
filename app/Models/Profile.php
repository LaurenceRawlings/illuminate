<?php

namespace App\Models;

use App\Helpers\Utils;
use App\Traits\HasUser;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasOne;

class Profile extends Model
{
    use HasFactory;
    use HasUser;

    protected $fillable = [
        'bio',
        'status_text',
        'status_emoji',
    ];
    protected $attributes = [
        'bio' => 'Hello 👋',
        'status_text' => 'Happy',
        'status_emoji' => '🙂',
    ];
    /**
     * The accessors to append to the model's array form.
     *
     * @var array
     */
    protected $appends = [
        'user',
        'total_posts',
        'total_views',
        'total_likes',
    ];

    public function post(): HasOne
    {
        return $this->hasOne(Post::class);
    }

    public function getTotalPostsAttribute(): string
    {
        return Utils::formatCount($this->user->posts->count());
    }

    public function getTotalViewsAttribute(): string
    {
        $views = 0;

        foreach ($this->user->posts as $post) {
            $views += $post->views;
        }

        return Utils::formatCount($views);
    }

    public function getTotalLikesAttribute(): string
    {
        $likes = 0;

        foreach ($this->user->posts as $post) {
            $likes += $post->likes;
        }

        return Utils::formatCount($likes);
    }
}
