<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Profile extends Model
{
    use HasFactory;

    protected $fillable = [
        'bio',
        'featured_article',
        'status_text',
        'status_emoji',
    ];
    protected $attributes = [
        'bio' => 'Hello 👋',
        'status_text' => 'Happy',
        'status_emoji' => '🙂',
    ];

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function post()
    {
        return $this->hasOne(Post::class);
    }
}
