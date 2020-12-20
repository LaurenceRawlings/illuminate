<?php


namespace App\Traits;


use App\Models\User;

trait HasUser
{
    public function getUserNameAttribute() {
        return User::query()->find($this->user_id)->name;
    }

    public function getUserPhotoAttribute() {
        return User::query()->find($this->user_id)->profile_photo_url;
    }
}
