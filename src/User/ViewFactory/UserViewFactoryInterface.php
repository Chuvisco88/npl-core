<?php

namespace Npl\User\ViewFactory;

use Npl\User\Entity\UserEntity;
use Npl\User\View\UserViewInterface;

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
     * @return UserViewInterface
     */
    public function create(UserEntity $user);
}