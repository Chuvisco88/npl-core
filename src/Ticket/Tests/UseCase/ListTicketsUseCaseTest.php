<?php

namespace Npl\Ticket\UseCase;

use Npl\Ticket\Entity\TicketEntity;
use Npl\Ticket\Tests\Fake\Repository\FakeTicketRepository;
use Npl\Ticket\Tests\Fake\Request\FakeListTicketsRequest;
use Npl\Ticket\Tests\Fake\Response\FakeListTicketsResponse;
use Npl\Ticket\Tests\Fake\ViewFactory\FakeTicketViewFactory;
use Npl\User\Entity\UserEntity;
use Npl\User\Tests\Fake\Repository\FakeUserRepository;

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

    private function processUseCase(array $tickets = [])
    {
        $userRepository = new FakeUserRepository($this->_users);

        $ticketRepository = new FakeTicketRepository($tickets);

        $ticketViewFactory = new FakeTicketViewFactory();

        $request = new FakeListTicketsRequest(self::USER_ID);
        $response = new FakeListTicketsResponse();

        $useCase = new ListTicketsUseCase($ticketRepository, $ticketViewFactory,
            $userRepository);
        $useCase->process($request, $response);

        return $response;
    }
}