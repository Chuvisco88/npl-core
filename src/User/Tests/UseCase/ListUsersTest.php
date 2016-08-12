<?php

namespace Npl\User\UseCase;

use Npl\Core\Exception\IllegalStateException;
use Npl\User\Entity\UserEntity;
use Npl\User\Tests\Fake\Repository\FakeUserRepository;
use Npl\User\Tests\Fake\Response\FakeListUsersResponse;
use Npl\User\Tests\Fake\ViewFactory\FakeUserViewFactory;

/**
 * Class ListUsersTest
 *
 * @package Npl\User\UseCase
 */
class ListUsersTest extends \PHPUnit_Framework_TestCase
{
    public function testMissingDependency()
    {
        $this->setExpectedException(IllegalStateException::class);
        $this->processUseCase();
    }

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
    private function processUseCase($userRepository = null)
    {

        $userViewFactory = new FakeUserViewFactory();
        $response = new FakeListUsersResponse();
        $useCase = new ListUsersUseCase();
        if (null !== $userRepository) {
            $useCase->setUserRepository($userRepository);
        }
        $useCase->setUserViewFactory($userViewFactory);
        $useCase->process($response);
        return $response;
    }
}