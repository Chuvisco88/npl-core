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
        $response = $this->processUseCase();
    }

    public function testEmptyUsers()
    {
        $userRepository = new FakeUserRepository();
        $response = $this->processUseCase($userRepository);
        $this->assertEmpty($response->getUsers());
    }

    public function testUsers()
    {
        $users = [];
        $users[] = new UserEntity();
        $userRepository = new FakeUserRepository($users);
        $response = $this->processUseCase($userRepository);
        $this->assertNotEmpty($response->getUsers());
    }

    private function processUseCase($userRepository = null)
    {

        $userViewFactory = new FakeUserViewFactory();
        $request = new FakeListUsersRequest();
        $response = new FakeListUsersResponse();
        $useCase = new ListUsersUseCase();
        if (null !== $userRepository) {
            $useCase->setUserRepository($userRepository);
        }
        $useCase->setUserViewFactory($userViewFactory);
        $useCase->process($request, $response);
        return $response;
    }
}