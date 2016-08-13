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
    public function testHasNoTickets()
    {
        $userId = 1;
        $users = [];
        $user = new UserEntity();
        $user->setId($userId);
        $users[] = $user;
        $userRepository = new FakeUserRepository($users);

        $tickets = [];
        $ticketRepository = new FakeTicketRepository($tickets);

        $request = new FakeListTicketsRequest($userId);
        $response = new FakeListTicketsResponse();

        $useCase = new ListTicketsUseCase();
        $useCase->setTicketRepository($ticketRepository);
        $useCase->setUserRepository($userRepository);
        $useCase->process($request, $response);

        static::assertEmpty($response->getTickets());
    }

    public function testCanSeeTickets()
    {
        $userId = 1;
        $users = [];
        $user = new UserEntity();
        $user->setId($userId);
        $users[] = $user;
        $userRepository = new FakeUserRepository($users);

        $lanId = 1;
        $tickets = [];
        $ticket = new TicketEntity($userId, $lanId);
        $ticket->setId(1);
        $tickets[] = $ticket;
        $ticketRepository = new FakeTicketRepository($tickets);

        $ticketViewFactory = new FakeTicketViewFactory();

        $request = new FakeListTicketsRequest($userId);
        $response = new FakeListTicketsResponse();

        $useCase = new ListTicketsUseCase();
        $useCase->setTicketRepository($ticketRepository);
        $useCase->setTicketViewFactory($ticketViewFactory);
        $useCase->setUserRepository($userRepository);
        $useCase->process($request, $response);

        static::assertNotEmpty($response->getTickets());
        static::assertEquals(1, $this->count($response->getTickets()));
    }
}