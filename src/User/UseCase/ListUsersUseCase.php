<?php

namespace Npl\User\UseCase;

use Npl\Core\Exception\IllegalStateException;
use Npl\User\Repository\UserRepository;
use Npl\User\Response\ListUsersResponse;
use Npl\User\ViewFactory\UserViewFactory;

/**
 * Class ListUsersUseCase
 *
 * @package Npl\User\UseCase
 */
class ListUsersUseCase
{
    /**
     * @var UserRepository
     */
    private $_userRepository;
    /**
     * @var UserViewFactory
     */
    private $_userViewFactory;

    public function __construct(UserRepository $userRepository, UserViewFactory $userViewFactory)
    {
        $this->_userRepository = $userRepository;
        $this->_userViewFactory = $userViewFactory;
    }

    /**
     * @param ListUsersResponse $response
     *
     * @throws IllegalStateException
     */
    public function process(ListUsersResponse $response)
    {
        // Check if user exists
        $users = $this->_userRepository->findAll();

        if (!$users) {
            return;
        }

        foreach ($users as $user) {
            $userView = $this->_userViewFactory->create($user);
            $response->addUser($userView);
        }
    }
}