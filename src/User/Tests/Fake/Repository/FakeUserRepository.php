<?php

namespace Npl\User\Tests\Fake\Repository;

use Npl\User\Entity\UserEntity;
use Npl\User\Exception\UserNotFoundException;
use Npl\User\Repository\UserRepositoryInterface;

/**
 * Class FakeUserRepository
 *
 * @package Npl\User\Tests\Fake\Repository
 */
class FakeUserRepository implements UserRepositoryInterface
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

    /**
     * @param $userId
     *
     * @return UserEntity
     * @throws UserNotFoundException
     */
    public function findById($userId)
    {
        foreach ($this->_users as $user) {
            if ($user->getId() === $userId) {
                return $user;
            }
        }

        throw new UserNotFoundException();
    }
}