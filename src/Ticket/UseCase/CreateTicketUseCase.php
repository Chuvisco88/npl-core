<?php

namespace Npl\Ticket\UseCase;

use Npl\Lan\Entity\LanEntity;
use Npl\Lan\Exception\LanNotFoundException;
use Npl\Ticket\Collector\CreateTicketCollectorInterface;
use Npl\Ticket\Entity\TicketEntity;
use Npl\Ticket\Exception\MaxTicketsPerLanPerUserExceededException;
use Npl\Ticket\Request\CreateTicketRequestInterface;
use Npl\Ticket\Response\CreateTicketResponseInterface;
use Npl\Ticket\ViewFactory\TicketViewFactoryInterface;
use Npl\User\Entity\UserEntity;
use Npl\User\Exception\UserNotFoundException;

/**
 * Class CreateTicketUseCase
 *
 * @package Npl\Ticket\UseCase
 */
class CreateTicketUseCase
{
    /**
     * @var CreateTicketCollectorInterface
     */
    private $_createTicketCollector;
    /**
     * @var LanEntity
     */
    private $_lanEntity;
    /**
     * @var int
     */
    private $_lanId;
    /**
     * @var int
     */
    private $_maxNumberOfTicketsPerLanPerUser;
    /**
     * @var UserEntity
     */
    private $_userEntity;
    /**
     * @var int
     */
    private $_userId;
    /**
     * @var TicketViewFactoryInterface
     */
    private $_ticketViewFactory;

    public function __construct(
        CreateTicketCollectorInterface $createTicketCollector,
        TicketViewFactoryInterface $ticketViewFactory,
        $maxNumberOfTicketsPerLanPerUser
    ) {
        $this->_createTicketCollector = $createTicketCollector;
        $this->_ticketViewFactory = $ticketViewFactory;
        $this->_maxNumberOfTicketsPerLanPerUser = $maxNumberOfTicketsPerLanPerUser;
    }

    /**
     * @param CreateTicketRequestInterface $request
     * @param CreateTicketResponseInterface $response
     *
     * @return CreateTicketResponseInterface
     * @throws LanNotFoundException
     * @throws UserNotFoundException
     * @throws MaxTicketsPerLanPerUserExceededException
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

    /**
     * @throws UserNotFoundException
     */
    private function throwErrorIfNotAUser()
    {
        $this->_userEntity
            = $this->_createTicketCollector->findUserById($this->_userId);
    }

    /**
     * @throws LanNotFoundException
     */
    private function throwErrorIfNotALan()
    {
        $this->_lanEntity
            = $this->_createTicketCollector->findLanById($this->_lanId);
    }

    private function throwErrorIfNoTicketsLeft()
    {

    }

    /**
     * @throws MaxTicketsPerLanPerUserExceededException
     */
    private function throwErrorIfMaxTicketsOfUserReached()
    {
        $existingTickets = $this->_createTicketCollector->findTicketsByLanAndUser(
            $this->_lanId,
            $this->_userId
        );

        if (count($existingTickets) >= $this->_maxNumberOfTicketsPerLanPerUser) {
            throw new MaxTicketsPerLanPerUserExceededException();
        }
    }

    /**
     * @return TicketEntity
     */
    private function createTicket()
    {
        return new TicketEntity($this->_userEntity, $this->_lanEntity);
    }

    /**
     * @param TicketEntity                  $ticketEntity
     * @param CreateTicketResponseInterface $response
     */
    private function addTicketToResponse(
        TicketEntity $ticketEntity,
        CreateTicketResponseInterface $response
    ) {
        $ticketView = $this->_ticketViewFactory->create($ticketEntity);
        $response->setTicket($ticketView);
    }
}