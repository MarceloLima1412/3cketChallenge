<?php

namespace App\Services\User;

interface UserServiceInterface
{
    public function create(string $name, string $email, string $password);
}
