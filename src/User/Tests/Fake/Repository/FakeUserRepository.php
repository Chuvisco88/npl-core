<?php

namespace Npl\User\Tests\Fake\Repository;

use Npl\User\Repository\UserRepository;

class FakeUserRepository implements UserRepository
{
    private $_users = [];

    public function __construct(array $users = [])
    {
        $this->_users = $users;
    }

    public function findAll()
    {
        return $this->_users;
    }
}