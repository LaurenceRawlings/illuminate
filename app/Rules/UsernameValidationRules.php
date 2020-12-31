<?php


namespace App\Rules;


use Illuminate\Validation\Rule;

trait UsernameValidationRules
{
    protected function usernameRules($user = null): array
    {
        $forbiddenUsernames = ['read', 'write', 'news', 'dashboard'];
        $baseRules = ['required', 'max:25', 'min:6', 'alpha_dash', Rule::notIn($forbiddenUsernames)];

        if ($user) {
            array_push($baseRules, Rule::unique('users')->ignore($user->id));
        } else {
            array_push($baseRules, 'unique:users');
        }

        return $baseRules;
    }
}
