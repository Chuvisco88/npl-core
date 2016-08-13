<?php

namespace Npl\User\UseCase;

use Npl\User\Entity\UserEntity;
use Npl\User\Tests\Fake\Repository\FakeUserRepository;
use Npl\User\Tests\Fake\Response\FakeListUsersResponse;
use Npl\User\Tests\Fake\ViewFactory\FakeUserViewFactory;

/**
 * Class ListUsersTest
 *
 * @package Npl\User\UseCase
 */
class ListUsersUseCaseTest extends \PHPUnit_Framework_TestCase
{
    public function testEmptyUsers()
    {
        $userRepository = new FakeUserRepository();
        $response = $this->processUseCase($userRepository);
        static::assertEmpty($response->getUsers());
    }

    public function testUsers()
    {
        $users = [];
        $users[] = new UserEntity();
        $userRepository = new FakeUserRepository($users);
        $response = $this->processUseCase($userRepository);
        static::assertNotEmpty($response->getUsers());
    }

    /**
     * @param null $userRepository
     *
     * @return FakeListUsersResponse
     */
    private function processUseCase($userRepository)
    {

        $userViewFactory = new FakeUserViewFactory();
        $response = new FakeListUsersResponse();
        $useCase = new ListUsersUseCase($userRepository, $userViewFactory);
        $useCase->process($response);
        return $response;
    }
}