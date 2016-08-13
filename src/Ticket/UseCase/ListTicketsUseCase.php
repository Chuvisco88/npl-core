<?php

namespace Npl\Ticket\UseCase;

use Npl\Ticket\Repository\TicketRepository;
use Npl\Ticket\Request\ListTicketsRequest;
use Npl\Ticket\Response\ListTicketsResponse;
use Npl\Ticket\ViewFactory\TicketViewFactory;
use Npl\User\Repository\UserRepository;

/**
 * Class ListTicketsUseCase
 *
 * @package Npl\Ticket\UseCase
 */
class ListTicketsUseCase
{
    /**
     * @var TicketRepository
     */
    private $_ticketRepository;
    /**
     * @var TicketViewFactory
     */
    private $_ticketViewFactory;
    /**
     * @var UserRepository
     */
    private $_userRepository;

    /**
     * @param TicketRepository $ticketRepository
     *
     * @return $this
     */
    public function setTicketRepository(TicketRepository $ticketRepository)
    {
        $this->_ticketRepository = $ticketRepository;
        return $this;
    }

    /**
     * @param TicketViewFactory $ticketViewFactory
     *
     * @return $this
     */
    public function setTicketViewFactory(TicketViewFactory $ticketViewFactory)
    {
        $this->_ticketViewFactory = $ticketViewFactory;
        return $this;
    }

    /**
     * @param UserRepository $userRepository
     *
     * @return $this
     */
    public function setUserRepository(UserRepository $userRepository)
    {
        $this->_userRepository = $userRepository;
        return $this;
    }

    /**
     * @param ListTicketsRequest  $request
     * @param ListTicketsResponse $response
     *
     * @return ListTicketsResponse|void
     */
    public function process(ListTicketsRequest $request, ListTicketsResponse $response)
    {
        $userId = $request->getUserId();
        $user = $this->_userRepository->findById($userId);

        if (!$user) {
            return;
        }

        $tickets = $this->_ticketRepository->findByUserId($userId);

        foreach ($tickets as $ticket) {
            $ticketView = $this->_ticketViewFactory->create($ticket);
            $response->addTicket($ticketView);
        }

        return $response;
    }
}