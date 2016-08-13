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
    private $_users = [];

    public function testHasNoUsers()
    {
        $response = $this->processUseCase();
        static::assertEmpty($response->getUsers());
    }

    public function testCanSeeUsers()
    {
        $this->_users[] = new UserEntity();
        $response = $this->processUseCase();
        static::assertNotEmpty($response->getUsers());
    }

    /**
     * @return FakeListUsersResponse
     */
    private function processUseCase()
    {
        $userRepository = new FakeUserRepository($this->_users);
        $userViewFactory = new FakeUserViewFactory();
        $response = new FakeListUsersResponse();
        $useCase = new ListUsersUseCase($userRepository, $userViewFactory);
        $useCase->process($response);
        return $response;
    }
}