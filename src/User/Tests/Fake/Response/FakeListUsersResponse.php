<?php

namespace Npl\User\Tests\Fake\Response;

use Npl\User\Response\ListUsersResponse;
use Npl\User\View\UserView;

class FakeListUsersResponse implements ListUsersResponse
{
    private $_users = [];

    public function addUser(UserView $userView)
    {
        $this->_users[] = $userView;
        return $this;
    }

    public function getUsers()
    {
        return $this->_users;
    }
}