<?php

namespace Npl\User\UseCase;

use Npl\Core\Exception\IllegalStateException;
use Npl\User\Entity\UserEntity;
use Npl\User\Tests\Fake\Repository\FakeUserRepository;
use Npl\User\Tests\Fake\Request\FakeListUsersRequest;
use Npl\User\Tests\Fake\Response\FakeListUsersResponse;
use Npl\User\Tests\Fake\ViewFactory\FakeUserViewFactory;

class ListUsersTest extends \PHPUnit_Framework_TestCase
{
    public function testMissingDependency()
    {
        $this->setExpectedException(IllegalStateException::class);
        $request = new FakeListUsersRequest();
        $response = new FakeListUsersResponse();
        $useCase = new ListUsersUseCase();
        $useCase->process($request, $response);
    }

    public function testEmptyUsers()
    {
        $userRepository = new FakeUserRepository();
        $userViewFactory = new FakeUserViewFactory();
        $request = new FakeListUsersRequest();
        $response = new FakeListUsersResponse();
        $useCase = new ListUsersUseCase();
        $useCase->setUserRepository($userRepository);
        $useCase->setUserViewFactory($userViewFactory);
        $useCase->process($request, $response);
        $this->assertEmpty($response->getUsers());
    }

    public function testUsers()
    {
        $users = [];
        $users[] = new UserEntity();
        $userRepository = new FakeUserRepository($users);
        $userViewFactory = new FakeUserViewFactory();
        $request = new FakeListUsersRequest();
        $response = new FakeListUsersResponse();
        $useCase = new ListUsersUseCase();
        $useCase->setUserRepository($userRepository);
        $useCase->setUserViewFactory($userViewFactory);
        $useCase->process($request, $response);
        $this->assertNotEmpty($response->getUsers());
    }
}