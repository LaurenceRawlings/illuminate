<?php


namespace App\Traits;


trait Deletable
{
    /**
     * @return bool|null
     */
    public function getCanDeleteAttribute(): ?bool
    {
        return optional(auth()->user())->can('delete', $this);
    }
}
