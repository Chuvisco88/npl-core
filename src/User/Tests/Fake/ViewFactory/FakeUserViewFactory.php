<?php

namespace Npl\User\Tests\Fake\ViewFactory;

use Npl\User\Entity\UserEntity;
use Npl\User\Tests\Fake\View\FakeUserView;
use Npl\User\ViewFactory\UserViewFactory;

class FakeUserViewFactory implements UserViewFactory
{
    public function create(UserEntity $user)
    {
        $view = new FakeUserView();
        $view->setEmail($user->getEmail());
        $view->setNickname($user->getNickname());
        return $view;
    }
}