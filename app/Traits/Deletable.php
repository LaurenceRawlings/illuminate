<?php


namespace App\Traits;


trait Deletable
{
    public function getCanDeleteAttribute()
    {
        return optional(auth()->user())->can('delete', $this);
    }
}
