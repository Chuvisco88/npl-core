<?php

namespace Npl\Ticket\UseCase;

use Npl\Lan\Entity\LanEntity;
use Npl\Ticket\Entity\TicketEntity;
use Npl\Ticket\Generator\TicketGenerator;
use Npl\Ticket\Tests\Fake\Repository\FakeTicketRepository;
use Npl\Ticket\Tests\Fake\Request\FakeListTicketsRequest;
use Npl\Ticket\Tests\Fake\Response\FakeListTicketsResponse;
use Npl\Ticket\Tests\Fake\ViewFactory\FakeTicketViewFactory;
use Npl\User\Entity\UserEntity;
use Npl\User\Exception\UserNotFoundException;
use Npl\User\Tests\Fake\Repository\FakeUserRepository;

class ListTicketsUseCaseTest extends \PHPUnit_Framework_TestCase
{
    const LAN_ID = 1;
    const NUMBER_OF_TICKETS = 3;
    const USER_ID = 1;

    private $_lan;
    private $_user;
    private $_users = [];
    private $_ticketRepository;

    public function setUp()
    {
        $this->_lan = new LanEntity('noprobLan vX.Y',
            new \DateTime('yesterday 18:00'), new \DateTime('tomorrow 16:00'));
        $this->_user = new UserEntity();
        $this->_user->setId(self::USER_ID);
        $this->_users[] = $this->_user;
    }

    public function testHasNoTickets()
    {
        $this->_setupTicketRepository(0);
        $response = $this->processUseCase();

        static::assertEmpty($response->getTickets());
    }

    public function testCanSeeTickets()
    {
        $this->_setupTicketRepository(self::NUMBER_OF_TICKETS);

        $response = $this->processUseCase();

        static::assertNotEmpty($response->getTickets());
        static::assertCount(self::NUMBER_OF_TICKETS, $response->getTickets());
    }

    public function testUserNotFoundException()
    {
        $this->setExpectedException(UserNotFoundException::class);

        $this->_setupTicketRepository(0);
        $this->_users = [];

        $this->processUseCase();
    }

    /**
     * @return FakeListTicketsResponse
     */
    private function processUseCase()
    {
        $userRepository = new FakeUserRepository($this->_users);
        $ticketViewFactory = new FakeTicketViewFactory();
        $request = new FakeListTicketsRequest(self::USER_ID);
        $response = new FakeListTicketsResponse();

        $useCase = new ListTicketsUseCase($this->_ticketRepository, $ticketViewFactory,
            $userRepository);
        $useCase->process($request, $response);

        return $response;
    }

    /**
     * @param $numberOfTickets
     */
    private function _setupTicketRepository($numberOfTickets)
    {
        $ticketConfiguration = new TicketEntity($this->_user, $this->_lan);
        $ticketGenerator = new TicketGenerator($ticketConfiguration, $numberOfTickets);
        $tickets = $ticketGenerator->generate();
        $this->_ticketRepository = new FakeTicketRepository($tickets);
    }
}