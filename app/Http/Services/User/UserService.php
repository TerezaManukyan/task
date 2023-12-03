<?php

namespace App\Http\Services\User;

use App\Models\User;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Str;

class UserService implements IUserService
{
    public function store(array $data)
    {
        unset($data['password_confirmation']);

        $data['password'] = Hash::make($data['password']);

        $user = User::create($data);
        $user->remember_token = Str::random(10);
        $user->save();

        return $user;
    }
}
