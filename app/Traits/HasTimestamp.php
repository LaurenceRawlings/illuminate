<?php


namespace App\Traits;


use App\Models\NewsPost;

trait HasTimestamp
{
    public function getTimestampAttribute() {

        if ($this instanceof NewsPost) {
            return $this->published_at->diffForHumans();
        }

        return $this->created_at->diffForHumans();
    }
}
