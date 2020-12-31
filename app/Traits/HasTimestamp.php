<?php


namespace App\Traits;


trait HasTimestamp
{
    /**
     * @return string
     */
    public function getTimestampAttribute(): string
    {
        return $this->created_at->diffForHumans();
    }
}
