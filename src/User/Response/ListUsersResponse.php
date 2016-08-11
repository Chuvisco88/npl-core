<?php

namespace Npl\User\Response;

use Npl\User\View\UserView;

interface ListUsersResponse
{
    public function addUser(UserView $userView);
    public function getUsers();
}