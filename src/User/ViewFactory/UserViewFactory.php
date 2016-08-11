<?php

namespace Npl\User\ViewFactory;

use Npl\User\Entity\UserEntity;

interface UserViewFactory
{
    public function create(UserEntity $user);
}