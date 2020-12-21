<?php


namespace App\Traits;


use App\Models\User;

trait HasUser
{
    public function getUserAttribute() {
        return User::query()->find($this->user_id);
    }
}
