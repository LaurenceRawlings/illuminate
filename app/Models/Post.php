<?php

namespace App\Models;

use App\Helpers\Utils;
use App\Traits\Deletable;
use App\Traits\Editable;
use App\Traits\HasThumbnail;
use App\Traits\HasTimestamp;
use App\Traits\HasUser;
use App\Traits\Likeable;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Notifications\Notifiable;

class Post extends Model
{
    use HasFactory;
    use HasThumbnail;
    use HasUser;
    use HasTimestamp;
    use Editable;
    use Deletable;
    use Likeable;
    use Notifiable;

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
        'user',
        'timestamp',
        'edited',
        'likes',
        'is_liked',
        'can_edit',
        'can_delete',
    ];

    /**
     * The attributes that should be cast to native types.
     *
     * @var array
     */
    protected $casts = [
        'created_at' => 'datetime',
    ];

    public function comments(): HasMany
    {
        return $this->hasMany(Comment::class)->latest();
    }

    public function getViewsFormattedAttribute(): string
    {
        return Utils::formatCount($this->views);
    }
}
