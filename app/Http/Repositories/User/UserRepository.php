<?php

namespace App\Http\Repositories\User;

use App\Models\User;

class UserRepository implements IUserRepository
{
    public function getUserByEmail(string $email)
    {
        return User::where('email', $email)->first();
    }

    public function getUserById(int $id)
    {
        return User::where('id', $id)->first();
    }
}
