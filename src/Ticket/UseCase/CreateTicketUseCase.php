<?php

namespace Npl\Ticket\UseCase;

use Npl\Lan\Exception\LanNotFoundException;
use Npl\Ticket\Collector\CreateTicketCollectorInterface;
use Npl\Ticket\Entity\TicketEntity;
use Npl\Ticket\Request\CreateTicketRequestInterface;
use Npl\Ticket\Response\CreateTicketResponseInterface;
use Npl\Ticket\ViewFactory\TicketViewFactoryInterface;
use Npl\User\Exception\UserNotFoundException;

/**
 * Class CreateTicketUseCase
 *
 * @package Npl\Ticket\UseCase
 */
class CreateTicketUseCase
{
    /**
     * @var TicketViewFactoryInterface
     */
    private $_ticketViewFactory;

    private $_userId;
    private $_lanId;
    private $_lanEntity;
    private $_userEntity;

    public function __construct(
        CreateTicketCollectorInterface $createTicketCollector,
        TicketViewFactoryInterface $ticketViewFactory
    ) {
        $this->_collector = $createTicketCollector;
        $this->_ticketViewFactory = $ticketViewFactory;
    }

    /**
     * @param CreateTicketRequestInterface  $request
     * @param CreateTicketResponseInterface $response
     *
     * @return CreateTicketResponseInterface
     * @throws LanNotFoundException
     * @throws UserNotFoundException
     */
    public function process(
        CreateTicketRequestInterface $request,
        CreateTicketResponseInterface $response
    ) {
        $this->_lanId = $request->getUserId();
        $this->_userId = $request->getUserId();

        $this->throwErrorIfNotAUser();
        $this->throwErrorIfNotALan();
        $this->throwErrorIfNoTicketsLeft();
        $this->throwErrorIfMaxTicketsOfUserReached();
        $ticket = $this->createTicket();
        $this->addTicketToResponse($ticket, $response);

        return $response;
    }

    private function throwErrorIfNotAUser()
    {
        $this->_userEntity = $this->_collector->findUserById($this->_userId);
    }

    private function throwErrorIfNotALan()
    {
        $this->_lanEntity = $this->_collector->findLanById($this->_lanId);
    }

    private function throwErrorIfNoTicketsLeft()
    {

    }

    private function throwErrorIfMaxTicketsOfUserReached()
    {
//        $this->_collector->findTicketsByLanAndUser($this->_lanId, $this->_userId);
    }

    private function createTicket()
    {
        return new TicketEntity($this->_userEntity, $this->_lanEntity);
    }

    private function addTicketToResponse(TicketEntity $ticketEntity, CreateTicketResponseInterface $response)
    {
        $ticketView = $this->_ticketViewFactory->create($ticketEntity);
        $response->setTicket($ticketView);
    }
}