<?php

namespace App\Models;

use App\Traits\HasUser;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Profile extends Model
{
    use HasFactory;
    use HasUser;

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

    public function post()
    {
        return $this->hasOne(Post::class);
    }
}
