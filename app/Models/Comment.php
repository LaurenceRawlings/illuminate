<?php

namespace App\Models;

use App\Traits\Editable;
use App\Traits\HasTimestamp;
use App\Traits\HasUser;
use App\Traits\Likeable;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Comment extends Model
{
    use HasFactory;
    use HasUser;
    use HasTimestamp;
    use Editable;
    use Likeable;

    protected $fillable = [
        'post_id',
        'comment',
        'created_at',
        'updated_at',
    ];
    /**
     * The accessors to append to the model's array form.
     *
     * @var array
     */
    protected $appends = [
        'user',
        'timestamp',
        'edited',
        'likes',
        'is_liked',
        'can_edit',
    ];

    public function post()
    {
        return $this->belongsTo(Post::class);
    }
}
