<?php

namespace Npl\Ticket\UseCase;

use Npl\Lan\Entity\LanEntity;
use Npl\Lan\Exception\LanNotFoundException;
use Npl\Lan\Repository\LanRepositoryInterface;
use Npl\Ticket\Exception\MaxTicketsPerLanPerUserExceededException;
use Npl\Ticket\Generator\TicketGenerator;
use Npl\Ticket\Tests\Fake\Collector\FakeCreateTicketCollector;
use Npl\Ticket\Tests\Fake\Generator\FakeTicketGeneratorConfiguration;
use Npl\Ticket\Tests\Fake\Repository\FakeTicketRepository;
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
    const MAX_NUMBER_OF_TICKETS_PER_LAN_PER_USER = 5;

    private $_lan;
    private $_lanName = 'noprobLAN vX.Y';

    private $_requestLanId;
    private $_requestUserId;
    private $_user;
    private $_userNickname = 'User Nickname';

    private $_lanRepository;
    private $_userRepository;
    private $_ticketRepository;
    private $_createTicketCollector;
    private $_tickets;

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

    public function testNoTicketsLeftException()
    {
        $this->_setupLanRepository();
        $this->_setupUserRepository();
        $this->_setupTicketRepository(self::MAX_NUMBER_OF_TICKETS_PER_LAN_PER_USER);

        $this->setExpectedException(MaxTicketsPerLanPerUserExceededException::class);

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

    private function _setupTicketRepository($numberOfTickets = 0)
    {
        $ticketConfiguration = new FakeTicketGeneratorConfiguration($this->_user, $this->_lan);
        $ticketGenerator = new TicketGenerator($ticketConfiguration, $numberOfTickets);
        $tickets = $ticketGenerator->generate();
        $this->_ticketRepository = new FakeTicketRepository($tickets);
    }

    private function _setupCollector()
    {
        $this->_createTicketCollector = new FakeCreateTicketCollector(
            $this->_lanRepository,
            $this->_ticketRepository,
            $this->_userRepository
        );
    }

    /**
     * @return FakeCreateTicketResponse
     */
    private function processUseCase()
    {
        $ticketViewFactory = new FakeTicketViewFactory();
        $request = new FakeCreateTicketRequest($this->_requestLanId, $this->_requestUserId);
        $response = new FakeCreateTicketResponse();
        $this->_setupCollector();

        $useCase = new CreateTicketUseCase(
            $this->_createTicketCollector,
            $ticketViewFactory,
            self::MAX_NUMBER_OF_TICKETS_PER_LAN_PER_USER
        );

        $useCase->process($request, $response);

        return $response;
    }
}