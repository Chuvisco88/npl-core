<?php

namespace Npl\User\Response;

use Npl\User\View\UserView;

/**
 * Interface ListUsersResponse
 *
 * @package Npl\User\Response
 */
interface ListUsersResponse
{
    /**
     * @param UserView $userView
     *
     * @return mixed
     */
    public function addUser(UserView $userView);

    /**
     * @return mixed
     */
    public function getUsers();
}