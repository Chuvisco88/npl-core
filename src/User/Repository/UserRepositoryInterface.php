<?php

namespace Npl\User\Repository;

use Npl\User\Entity\UserEntity;
use Npl\User\Exception\UserNotFoundException;

/**
 * Interface UserRepositoryInterface
 *
 * @package Npl\User\RepositoryInterface
 */
interface UserRepositoryInterface
{
    /**
     * @return UserEntity[]
     */
    public function findAll();

    /**
     * @param $userId
     *
     * @return UserEntity
     * @throws UserNotFoundException
     */
    public function findById($userId);
}