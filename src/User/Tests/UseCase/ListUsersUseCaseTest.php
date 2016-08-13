<?php

namespace Npl\User\UseCase;

use Npl\Core\Exception\IllegalStateException;
use Npl\User\Entity\UserEntity;
use Npl\User\Tests\Fake\Repository\FakeUserRepositoryInterface;
use Npl\User\Tests\Fake\Response\FakeListUsersResponseInterface;
use Npl\User\Tests\Fake\ViewFactory\FakeUserViewFactoryInterface;

/**
 * Class ListUsersTest
 *
 * @package Npl\User\UseCase
 */
class ListUsersUseCaseTest extends \PHPUnit_Framework_TestCase
{
    public function testEmptyUsers()
    {
        $userRepository = new FakeUserRepositoryInterface();
        $response = $this->processUseCase($userRepository);
        static::assertEmpty($response->getUsers());
    }

    public function testUsers()
    {
        $users = [];
        $users[] = new UserEntity();
        $userRepository = new FakeUserRepositoryInterface($users);
        $response = $this->processUseCase($userRepository);
        static::assertNotEmpty($response->getUsers());
    }

    /**
     * @param null $userRepository
     *
     * @return FakeListUsersResponseInterface
     */
    private function processUseCase($userRepository)
    {

        $userViewFactory = new FakeUserViewFactoryInterface();
        $response = new FakeListUsersResponseInterface();
        $useCase = new ListUsersUseCase($userRepository, $userViewFactory);
        $useCase->process($response);
        return $response;
    }
}