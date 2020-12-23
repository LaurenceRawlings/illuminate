<?php


namespace App\Traits;


trait Editable
{
    public function getEditedAttribute() {
        return $this->created_at != $this->updated_at;
    }
}
