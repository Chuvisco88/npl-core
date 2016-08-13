<?php

namespace Npl\User\UseCase;

use Npl\User\Repository\UserRepositoryInterface;
use Npl\User\Response\ListUsersResponseInterface;
use Npl\User\ViewFactory\UserViewFactoryInterface;

/**
 * Class ListUsersUseCase
 *
 * @package Npl\User\UseCase
 */
class ListUsersUseCase
{
    /**
     * @var UserRepositoryInterface
     */
    private $_userRepository;
    /**
     * @var UserViewFactoryInterface
     */
    private $_userViewFactory;

    public function __construct(UserRepositoryInterface $userRepository, UserViewFactoryInterface $userViewFactory)
    {
        $this->_userRepository = $userRepository;
        $this->_userViewFactory = $userViewFactory;
    }

    /**
     * @param ListUsersResponseInterface $response
     */
    public function process(ListUsersResponseInterface $response)
    {
        // Check if user exists
        $users = $this->_userRepository->findAll();

        foreach ($users as $user) {
            $userView = $this->_userViewFactory->create($user);
            $response->addUser($userView);
        }
    }
}