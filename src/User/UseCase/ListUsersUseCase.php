<?php

namespace Npl\User\UseCase;

use Npl\Core\Exception\IllegalStateException;
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
     *
     * @throws IllegalStateException
     */
    public function process(ListUsersResponseInterface $response)
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