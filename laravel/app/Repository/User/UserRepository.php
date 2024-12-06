<?php

namespace App\Repository\User;

use App\Repository\Repository;
use App\User;

/**
 * Class UserRepository
 * @package App\Repository\User
 */
class UserRepository extends Repository implements UserRepositoryInterface
{
    /**
     * @var User
     */
    protected $model;

    /**
     * UserRepository constructor.
     * @param User $model
     */
    public function __construct(User $model)
    {
        parent::__construct($model);
    }

    /**
     * Create method
     * @param string $name
     * @param string $email
     * @param string $password
     * @return User
     */
    public function create(string $name, string $email, string $password): User
    {
        return $this->model::create([
            'name'      => $name,
            'email'     => $email,
            'password'  => $password
        ]);
    }
}
