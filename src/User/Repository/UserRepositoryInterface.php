<?php

namespace Npl\User\Repository;

use Npl\User\Exception\UserNotFoundException;

/**
 * Interface UserRepositoryInterface
 *
 * @package Npl\User\RepositoryInterface
 */
interface UserRepositoryInterface
{
    /**
     * @return array
     */
    public function findAll();

    /**
     * @param $userId
     *
     * @return array
     * @throws UserNotFoundException
     */
    public function findById($userId);
}