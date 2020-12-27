<?php

namespace App\Models;

use App\Helpers\Utils;
use App\Traits\HasUser;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

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

    public function post()
    {
        return $this->hasOne(Post::class);
    }

    public function getTotalPostsAttribute()
    {
        return Utils::formatCount($this->user->posts->count());
    }

    public function getTotalViewsAttribute()
    {
        $views = 0;

        foreach ($this->user->posts as $post)
        {
            $views += $post->views;
        }

        return Utils::formatCount($views);
    }

    public function getTotalLikesAttribute()
    {
        $likes = 0;

        foreach ($this->user->posts as $post)
        {
            $likes += $post->likes;
        }

        return Utils::formatCount($likes);
    }
}
