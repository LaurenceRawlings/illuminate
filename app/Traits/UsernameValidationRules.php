<?php


namespace App\Traits;


use Illuminate\Validation\Rule;

trait UsernameValidationRules
{
    protected function usernameRules($user = null) {
        $forbiddenUsernames = ['read', 'write', 'news', 'dashboard'];

        if ($user) {
            return ['required', 'max:25', Rule::unique('users')->ignore($user->id), Rule::notIn($forbiddenUsernames)];
        }

        return ['required', 'max:25', 'unique:users', Rule::notIn($forbiddenUsernames)];
    }
}
