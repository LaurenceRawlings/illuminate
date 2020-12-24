<?php


namespace App\Traits;


use App\Models\User;

trait HasUser
{
    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function getUserAttribute() {
        return $this->user()->first();
    }
}
