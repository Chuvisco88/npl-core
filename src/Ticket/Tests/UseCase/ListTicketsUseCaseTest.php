<?php

namespace Npl\Ticket\UseCase;

use Npl\Ticket\Entity\TicketEntity;
use Npl\Ticket\Tests\Fake\Repository\FakeTicketRepositoryInterface;
use Npl\Ticket\Tests\Fake\Request\FakeListTicketsRequestInterface;
use Npl\Ticket\Tests\Fake\Response\FakeListTicketsResponseInterface;
use Npl\Ticket\Tests\Fake\ViewFactory\FakeTicketViewFactoryInterface;
use Npl\User\Entity\UserEntity;
use Npl\User\Exception\UserNotFoundException;
use Npl\User\Tests\Fake\Repository\FakeUserRepositoryInterface;

class ListTicketsUseCaseTest extends \PHPUnit_Framework_TestCase
{
    const LAN_ID = 1;
    const NUMBER_OF_TICKETS = 3;
    const USER_ID = 1;

    private $_user;
    private $_users = [];

    public function setUp()
    {
        $this->_user = new UserEntity();
        $this->_user->setId(self::USER_ID);
        $this->_users[] = $this->_user;
    }

    public function testHasNoTickets()
    {
        $response = $this->processUseCase();

        static::assertEmpty($response->getTickets());
    }

    public function testCanSeeTickets()
    {
        $tickets = [];

        for ($ticketId = 1; $ticketId <= self::NUMBER_OF_TICKETS; $ticketId++) {
            $ticket = new TicketEntity($this->_user, self::LAN_ID);
            $ticket->setId($ticketId);
            $tickets[] = $ticket;
        }

        $response = $this->processUseCase($tickets);

        static::assertNotEmpty($response->getTickets());
        static::assertCount(self::NUMBER_OF_TICKETS, $response->getTickets());
    }

    public function testUserNotFoundException()
    {
        $this->setExpectedException(UserNotFoundException::class);

        $this->_users = [];
        $this->processUseCase();
    }

    private function processUseCase(array $tickets = [])
    {
        $userRepository = new FakeUserRepositoryInterface($this->_users);

        $ticketRepository = new FakeTicketRepositoryInterface($tickets);

        $ticketViewFactory = new FakeTicketViewFactoryInterface();

        $request = new FakeListTicketsRequestInterface(self::USER_ID);
        $response = new FakeListTicketsResponseInterface();

        $useCase = new ListTicketsUseCase($ticketRepository, $ticketViewFactory,
            $userRepository);
        $useCase->process($request, $response);

        return $response;
    }
}