<?php

namespace Npl\Ticket\UseCase;

use Npl\Lan\Entity\LanEntity;
use Npl\Ticket\Entity\TicketEntity;
use Npl\Ticket\Exception\TicketNotFoundException;
use Npl\Ticket\Tests\Fake\Repository\FakeTicketRepository;
use Npl\Ticket\Tests\Fake\Request\FakeViewTicketRequest;
use Npl\Ticket\Tests\Fake\Response\FakeViewTicketResponse;
use Npl\Ticket\Tests\Fake\ViewFactory\FakeTicketViewFactory;
use Npl\User\Entity\UserEntity;

class ViewTicketsUseCaseTest extends \PHPUnit_Framework_TestCase
{
    const TICKET_ID = 1;
    const INVALID_TICKET_ID = 0;

    private $_buyerNickname = 'Buyer Nickname';
    private $_holderNickname = 'Holder Nickname';
    private $_lanName = 'noprobLAN vX.Y';
    private $_requestTicketId;
    private $_ticketRepository;

    public function setUp()
    {
        $this->_requestTicketId = self::TICKET_ID;

        $buyer = new UserEntity();
        $buyer->setNickname($this->_buyerNickname);

        $holder = new UserEntity();
        $holder->setNickname($this->_holderNickname);

        $lan = new LanEntity($this->_lanName, new \DateTime('yesterday 18:00'), new \DateTime('tomorrow 16:00'));

        $ticket = new TicketEntity($buyer, $lan);
        $ticket->setId($this->_requestTicketId);
        $ticket->setHolder($holder);

        $this->_ticketRepository = new FakeTicketRepository(1, $lan, $buyer, $holder);
    }

    public function testCanSeeTicket()
    {
        $response = $this->processUseCase();

        static::assertSame($this->_buyerNickname, $response->getBuyerName());
        static::assertSame($this->_holderNickname, $response->getHolderName());
        static::assertSame($this->_lanName, $response->getLanName());
    }

    public function testTicketNotFoundException()
    {
        $this->setExpectedException(TicketNotFoundException::class);

        $this->_requestTicketId = self::INVALID_TICKET_ID;

        $this->processUseCase();
    }

    /**
     * @return FakeViewTicketResponse
     */
    private function processUseCase()
    {
        $ticketViewFactory = new FakeTicketViewFactory();
        $request = new FakeViewTicketRequest($this->_requestTicketId);
        $response = new FakeViewTicketResponse();

        $useCase = new ViewTicketUseCase($this->_ticketRepository, $ticketViewFactory);
        $useCase->process($request, $response);

        return $response;
    }
}