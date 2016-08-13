<?php

namespace Npl\User\Response;

use Npl\User\View\UserView;

/**
 * Interface ListUsersResponseInterface
 *
 * @package Npl\User\Response
 */
interface ListUsersResponseInterface
{
    /**
     * @param UserView $userView
     *
     * @return $this
     */
    public function addUser(UserView $userView);

    /**
     * @return array
     */
    public function getUsers();
}