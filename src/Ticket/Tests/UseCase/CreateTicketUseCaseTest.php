<?php

namespace Npl\Ticket\UseCase;

use Npl\Lan\Entity\LanEntity;
use Npl\Lan\Exception\LanNotFoundException;
use Npl\Lan\Tests\Fake\Repository\FakeLanRepository;
use Npl\Ticket\Tests\Fake\Repository\FakeTicketRepository;
use Npl\Ticket\Tests\Fake\Request\FakeCreateTicketRequest;
use Npl\Ticket\Tests\Fake\Response\FakeCreateTicketResponse;
use Npl\Ticket\Tests\Fake\ViewFactory\FakeTicketViewFactory;
use Npl\User\Entity\UserEntity;
use Npl\User\Exception\UserNotFoundException;
use Npl\User\Tests\Fake\Repository\FakeUserRepository;

class CreateTicketUseCaseTest extends \PHPUnit_Framework_TestCase
{
    const INVALID_LAN_ID = 0;
    const INVALID_USER_ID = 0;
    const MAX_NUMBER_OF_TICKETS = 5;
    const NUMBER_OF_TICKETS = 5;
    const LAN_ID = 1;
    const USER_ID = 1;

    private $_lan;
    private $_lanName = 'noprobLAN vX.Y';
    private $_lans = [];
    private $_requestLanId;
    private $_requestUserId;
    private $_user;
    private $_userNickname = 'User Nickname';
    private $_users = [];
    private $_tickets = [];

    public function setUp()
    {
        $this->_lan = new LanEntity($this->_lanName, new \DateTime('yesterday 18:00'), new \DateTime('tomorrow 16:00'));
        $this->_lan->setId(self::LAN_ID);
        $this->_lans[] = $this->_lan;

        $this->_requestLanId = self::LAN_ID;
        $this->_requestUserId = self::USER_ID;

        $this->_user = new UserEntity();
        $this->_user->setId(self::USER_ID);
        $this->_user->setNickname($this->_userNickname);
        $this->_users[] = $this->_user;

        $this->_tickets = [];
    }

    public function testCanCreateTicket()
    {
        $response = $this->processUseCase();

        static::assertSame($this->_userNickname, $response->getBuyerName());
        static::assertSame($this->_userNickname, $response->getHolderName());
        static::assertSame($this->_lanName, $response->getLanName());
    }

    public function testLanNotFoundException()
    {
        $this->setExpectedException(LanNotFoundException::class);

        $this->_requestLanId = self::INVALID_LAN_ID;

        $this->processUseCase();
    }

    public function testUserNotFoundException()
    {
        $this->setExpectedException(UserNotFoundException::class);

        $this->_requestUserId = self::INVALID_USER_ID;

        $this->processUseCase();
    }

    /**
     * @return FakeCreateTicketResponse
     */
    private function processUseCase()
    {
        $lanRepository = new FakeLanRepository($this->_lans);
        $ticketRepository = new FakeTicketRepository($this->_tickets);
        $ticketViewFactory = new FakeTicketViewFactory();
        $userRepository = new FakeUserRepository($this->_users);
        $request = new FakeCreateTicketRequest($this->_requestLanId, $this->_requestUserId);
        $response = new FakeCreateTicketResponse();

        $useCase = new CreateTicketUseCase($lanRepository, $ticketRepository, $ticketViewFactory, $userRepository);
        $useCase->process($request, $response);

        return $response;
    }
}