<?php

namespace App\Services;

use App\Models\User;

class UsersService
{

    public function handleChangeUserName($name, User $user)
    {
        $user->name = $name;
        $user->save();
    }

}

