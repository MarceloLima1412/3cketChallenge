<?php

namespace App\Repository\User;

use App\User;

/**
 * Class UserRepositoryInterface
 * @package App\Repository\User
 */
interface UserRepositoryInterface
{
    public function create(string $name, string $email, string $password): User;
}
