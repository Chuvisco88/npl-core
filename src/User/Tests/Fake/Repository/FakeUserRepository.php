<?php

namespace Npl\User\Tests\Fake\Repository;

use Npl\User\Repository\UserRepository;

/**
 * Class FakeUserRepository
 *
 * @package Npl\User\Tests\Fake\Repository
 */
class FakeUserRepository implements UserRepository
{
    /**
     * @var array
     */
    private $_users = [];

    /**
     * FakeUserRepository constructor.
     *
     * @param array $users
     */
    public function __construct(array $users = [])
    {
        $this->_users = $users;
    }

    /**
     * @return array
     */
    public function findAll()
    {
        return $this->_users;
    }

    public function findById($userId)
    {
        foreach ($this->_users as $user) {
            if ($user->getId() === $userId) {
                return $user;
            }
        }
    }
}