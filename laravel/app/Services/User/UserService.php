<?php

namespace App\Services\User;

use App\Repository\User\UserRepositoryInterface;
use Illuminate\Support\Facades\Hash;

class UserService implements UserServiceInterface
{
    /**
     * @var UserRepositoryInterface
     */
    private $userRepository;

    /**
     * UserService constructor
     * @param UserRepositoryInterface $userRepository
     */
    public function __construct(UserRepositoryInterface $userRepository)
    {
        $this->userRepository = $userRepository;
    }

    /**
     * Create handler
     * @param string $name
     * @param string $email
     * @param string $password
     * @return void
     */
    public function create(string $name, string $email, string $password)
    {
        $password = Hash::make($password);

        $this->userRepository->create(
            $name,
            $email,
            $password
        );
    }
}
