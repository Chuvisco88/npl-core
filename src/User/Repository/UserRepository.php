<?php

namespace Npl\User\Repository;

/**
 * Interface UserRepository
 *
 * @package Npl\User\Repository
 */
interface UserRepository
{
    /**
     * @return mixed
     */
    public function findAll();

    public function findById($userId);
}