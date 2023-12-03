<?php

namespace App\Http\Repositories\User;

interface IUserRepository
{
    public function getUserByEmail(string $email);

    public function getUserById(int $id);
}
