<?php

namespace App\Models;

use App\Traits\Deletable;
use App\Traits\Editable;
use App\Traits\HasTimestamp;
use App\Traits\HasUser;
use App\Traits\Likeable;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Comment extends Model
{
    use HasFactory;
    use HasUser;
    use HasTimestamp;
    use Editable;
    use Deletable;
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
        'can_delete',
    ];

    public function post(): BelongsTo
    {
        return $this->belongsTo(Post::class);
    }
}
