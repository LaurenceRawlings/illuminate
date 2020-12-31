<?php


namespace App\Traits;


trait Editable
{
    /**
     * @return bool
     */
    public function getEditedAttribute(): bool
    {
        return $this->created_at != $this->updated_at;
    }

    /**
     * @return bool|null
     */
    public function getCanEditAttribute(): ?bool
    {
        return optional(auth()->user())->can('update', $this);
    }
}
