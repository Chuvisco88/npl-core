<?php

namespace Npl\User\Tests\Fake\ViewFactory;

use Npl\User\Entity\UserEntity;
use Npl\User\Tests\Fake\View\FakeUserView;
use Npl\User\ViewFactory\UserViewFactoryInterface;

/**
 * Class FakeUserViewFactory
 *
 * @package Npl\User\Tests\Fake\ViewFactory
 */
class FakeUserViewFactoryInterface implements UserViewFactoryInterface
{
    /**
     * @param UserEntity $user
     *
     * @return FakeUserView
     */
    public function create(UserEntity $user)
    {
        $view = new FakeUserView();
        $view->setEmail($user->getEmail());
        $view->setNickname($user->getNickname());
        return $view;
    }
}