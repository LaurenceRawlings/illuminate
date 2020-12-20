<?php

namespace App\Models;

use App\Helpers\Utils;
use App\Traits\HasThumbnail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Post extends Model
{
    use HasFactory;
    use HasThumbnail;

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
        'views_formatted',
    ];

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function comments()
    {
        return $this->hasMany(Comment::class);
    }

    public function getViewsFormattedAttribute()
    {
        return Utils::formatViewCount($this->views);
    }
}
