<?php


namespace App\Traits;


trait Deletable
{
    public function getCanDeleteAttribute()
    {
        return auth()->user()->can('delete', $this);
    }
}
