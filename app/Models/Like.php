<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\MorphToMany;
use Illuminate\Database\Eloquent\SoftDeletes;

class Like extends Model
{
    use HasFactory;
    use SoftDeletes;

    protected $table = 'likeables';

    protected $fillable = [
        'user_id',
        'likeable_id',
        'likeable_type',
    ];

    public function posts(): MorphToMany
    {
        return $this->morphedByMany(Post::class, 'likeable');
    }

    public function comments(): MorphToMany
    {
        return $this->morphedByMany(Comment::class, 'likeable');
    }
}
