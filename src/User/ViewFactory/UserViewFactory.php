<?php

namespace Npl\User\ViewFactory;

use Npl\User\Entity\UserEntity;

/**
 * Interface UserViewFactory
 *
 * @package Npl\User\ViewFactory
 */
interface UserViewFactory
{
    /**
     * @param UserEntity $user
     *
     * @return mixed
     */
    public function create(UserEntity $user);
}