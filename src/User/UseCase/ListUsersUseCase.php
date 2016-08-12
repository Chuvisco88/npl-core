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

    /**
     * @param UserRepository $userRepository
     *
     * @return $this
     */
    public function setUserRepository(UserRepository $userRepository)
    {
        $this->_userRepository = $userRepository;
        return $this;
    }

    /**
     * @param UserViewFactory $userViewFactory
     *
     * @return $this
     */
    public function setUserViewFactory(UserViewFactory $userViewFactory)
    {
        $this->_userViewFactory = $userViewFactory;
        return $this;
    }

    /**
     * @param ListUsersResponse $response
     *
     * @throws IllegalStateException
     */
    public function process(ListUsersResponse $response)
    {
        if (null === $this->_userRepository || null === $this->_userViewFactory) {
            throw new IllegalStateException('Missing dependency');
        }

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