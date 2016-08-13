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

    public function __construct(
        TicketRepository $ticketRepository,
        TicketViewFactory $ticketViewFactory,
        UserRepository $userRepository
    ) {
        $this->_ticketRepository = $ticketRepository;
        $this->_ticketViewFactory = $ticketViewFactory;
        $this->_userRepository = $userRepository;
    }

    /**
     * @param ListTicketsRequest $request
     * @param ListTicketsResponse $response
     *
     * @return ListTicketsResponse|void
     */
    public function process(
        ListTicketsRequest $request,
        ListTicketsResponse $response
    ) {
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