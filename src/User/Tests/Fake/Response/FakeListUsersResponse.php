<?php

namespace Npl\User\Tests\Fake\Response;

use Npl\User\Response\ListUsersResponseInterface;
use Npl\User\View\UserView;

/**
 * Class FakeListUsersResponse
 *
 * @package Npl\User\Tests\Fake\Response
 */
class FakeListUsersResponseInterface implements ListUsersResponseInterface
{
    /**
     * @var array
     */
    private $_users = [];

    /**
     * @param UserView $userView
     *
     * @return $this
     */
    public function addUser(UserView $userView)
    {
        $this->_users[] = $userView;
        return $this;
    }

    /**
     * @return array
     */
    public function getUsers()
    {
        return $this->_users;
    }
}