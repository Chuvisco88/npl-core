<?php

namespace Npl\User\UseCase;

use Npl\Core\Exception\IllegalStateException;
use Npl\User\Repository\UserRepository;
use Npl\User\Request\ListUsersRequest;
use Npl\User\Response\ListUsersResponse;
use Npl\User\ViewFactory\UserViewFactory;

class ListUsersUseCase
{
    private $_userRepository;
    private $_userViewFactory;

    public function setUserRepository(UserRepository $userRepository)
    {
        $this->_userRepository = $userRepository;
        return $this;
    }

    public function setUserViewFactory(UserViewFactory $userViewFactory)
    {
        $this->_userViewFactory = $userViewFactory;
        return $this;
    }

    public function process(ListUsersRequest $request, ListUsersResponse $response)
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