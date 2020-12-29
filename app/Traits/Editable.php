<?php


namespace App\Traits;


trait Editable
{
    public function getEditedAttribute()
    {
        return $this->created_at != $this->updated_at;
    }

    public function getCanEditAttribute()
    {
        return optional(auth()->user())->can('update', $this);
    }
}
