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
    const USER_ID = 1;

    public function testHasNoTickets()
    {
        $response = $this->processUseCase();

        static::assertEmpty($response->getTickets());
    }

    public function testCanSeeTickets()
    {
        $users = [];
        $user = new UserEntity();
        $user->setId(self::USER_ID);
        $users[] = $user;

        $lanId = 1;
        $tickets = [];
        $ticket = new TicketEntity(self::USER_ID, $lanId);
        $ticket->setId(1);
        $tickets[] = $ticket;

        $response = $this->processUseCase($users, $tickets);

        static::assertNotEmpty($response->getTickets());
        static::assertEquals(1, $this->count($response->getTickets()));
    }

    private function processUseCase(array $users = [], array $tickets = [])
    {
        $userRepository = new FakeUserRepository($users);

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