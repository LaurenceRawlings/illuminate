<?php


namespace App\Traits;


use App\Models\User;

trait HasUser
{
    public function getUserAttribute()
    {
        return $this->user()->first();
    }

    public function user()
    {
        return $this->belongsTo(User::class);
    }
}
