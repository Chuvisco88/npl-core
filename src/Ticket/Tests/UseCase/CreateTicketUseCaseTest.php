<?php

namespace Npl\Ticket\UseCase;

use Npl\Lan\Entity\LanEntity;
use Npl\Lan\Exception\LanNotFoundException;
use Npl\Lan\Repository\LanRepositoryInterface;
use Npl\Ticket\Entity\TicketEntity;
use Npl\Ticket\Repository\TicketRepositoryInterface;
use Npl\Ticket\Tests\Fake\Request\FakeCreateTicketRequest;
use Npl\Ticket\Tests\Fake\Response\FakeCreateTicketResponse;
use Npl\Ticket\Tests\Fake\ViewFactory\FakeTicketViewFactory;
use Npl\User\Entity\UserEntity;
use Npl\User\Exception\UserNotFoundException;
use Npl\User\Repository\UserRepositoryInterface;

class CreateTicketUseCaseTest extends \PHPUnit_Framework_TestCase
{
    const LAN_ID = 1;
    const USER_ID = 1;

    private $_lan;
    private $_lanName = 'noprobLAN vX.Y';

    private $_requestLanId;
    private $_requestUserId;
    private $_user;
    private $_userNickname = 'User Nickname';

    private $_lanRepository;
    private $_userRepository;
    private $_ticketRepository;

    public function setUp()
    {
        $this->_setupLanEntity();
        $this->_setupUserEntity();

        $this->_requestLanId = self::LAN_ID;
        $this->_requestUserId = self::USER_ID;

        $this->_tickets = [];
    }

    public function testCanCreateTicket()
    {
        $this->_setupLanRepository();
        $this->_setupUserRepository();
        $this->_setupTicketRepository();

        $response = $this->processUseCase();

        static::assertSame($this->_userNickname, $response->getBuyerName());
        static::assertSame($this->_userNickname, $response->getHolderName());
        static::assertSame($this->_lanName, $response->getLanName());
    }

    public function testLanNotFoundException()
    {
        $this->_setupLanRepository(true);
        $this->_setupUserRepository();
        $this->_setupTicketRepository();

        $this->setExpectedException(LanNotFoundException::class);

        $this->processUseCase();
    }

    public function testUserNotFoundException()
    {
        $this->_setupLanRepository();
        $this->_setupUserRepository(true);
        $this->_setupTicketRepository();

        $this->setExpectedException(UserNotFoundException::class);


        $this->processUseCase();
    }

    private function _setupLanEntity()
    {
        $this->_lan = new LanEntity(
            $this->_lanName,
            new \DateTime('yesterday 18:00'),
            new \DateTime('tomorrow 16:00')
        );
        $this->_lan->setId(self::LAN_ID);
    }

    private function _setupUserEntity()
    {
        $this->_user = new UserEntity();
        $this->_user->setId(self::USER_ID);
        $this->_user->setNickname($this->_userNickname);
    }

    private function _setupLanRepository($shouldThrowNotFoundError = false)
    {
        $this->_lanRepository = $this->getMock(LanRepositoryInterface::class);
        if ($shouldThrowNotFoundError) {
            $this->_lanRepository->method('findById')
                ->willThrowException(new LanNotFoundException());
        } else {
            $this->_lanRepository->method('findById')
                ->willReturn($this->_lan);
        }
    }

    private function _setupUserRepository($shouldThrowNotFoundError = false)
    {
        $this->_userRepository = $this->getMock(UserRepositoryInterface::class);
        if ($shouldThrowNotFoundError) {
            $this->_userRepository->method('findById')
                ->willThrowException(new UserNotFoundException());
        } else {
            $this->_userRepository->method('findById')
                ->willReturn($this->_user);
        }
    }

    private function _setupTicketRepository($addNumberOfTickets = 0)
    {
        $this->_ticketRepository = $this->getMock(TicketRepositoryInterface::class);
        $tickets = [];

        for ($ticketId = 1; $ticketId <= $addNumberOfTickets; $ticketId++) {
            $ticket = new TicketEntity($this->_user, $this->_lan);
            $ticket->setId($ticketId + 1);
            $tickets[] = $ticket;
        }

        $this->_ticketRepository->method('findByUserId')
            ->willReturn($tickets);
    }

    /**
     * @return FakeCreateTicketResponse
     */
    private function processUseCase()
    {
        $ticketViewFactory = new FakeTicketViewFactory();
        $request = new FakeCreateTicketRequest($this->_requestLanId, $this->_requestUserId);
        $response = new FakeCreateTicketResponse();

        $useCase = new CreateTicketUseCase(
            $this->_lanRepository,
            $this->_ticketRepository,
            $ticketViewFactory,
            $this->_userRepository
        );

        $useCase->process($request, $response);

        return $response;
    }
}