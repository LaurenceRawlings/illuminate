<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Inertia\Inertia;

class UserController extends Controller
{
    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Inertia\Response
     */
    public function show($username)
    {
        $user = User::query()->where('username', '=', $username)->firstOrFail();


        return Inertia::render('User/Show', [
            'user' => $user,
            'profile' => $user->profile,
        ]);
    }
}
