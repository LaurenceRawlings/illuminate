<?php


namespace App\Traits;


trait HasTimestamp
{
    public function getTimestampAttribute() {
        return $this->created_at->diffForHumans();
    }
}
