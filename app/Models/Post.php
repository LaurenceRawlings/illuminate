<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Storage;

class Post extends Model
{
    use HasFactory;

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function comments()
    {
        return $this->hasMany(Comment::class);
    }

    public function getThumbnailUrlAttribute()
    {
        return $this->thumbnail
            ? Storage::disk('public')->url($this->thumbnail)
            : '/img/placeholder.png';
    }

    protected $fillable = [
        'title',
        'description',
        'body',
        'thumbnail',
    ];

    protected $attributes = [
        'views' => 0,
    ];

    /**
     * The accessors to append to the model's array form.
     *
     * @var array
     */
    protected $appends = [
        'thumbnail_url',
    ];
}
