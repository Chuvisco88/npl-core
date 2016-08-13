<?php

namespace Npl\User\ViewFactory;

use Npl\User\Entity\UserEntity;

/**
 * Interface UserViewFactoryInterface
 *
 * @package Npl\User\ViewFactory
 */
interface UserViewFactoryInterface
{
    /**
     * @param UserEntity $user
     *
     * @return $this
     */
    public function create(UserEntity $user);
}