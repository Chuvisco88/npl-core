<?php

namespace Npl\Ticket\UseCase;

use Npl\Ticket\Repository\TicketRepository;
use Npl\Ticket\Request\ListTicketsRequest;
use Npl\Ticket\Response\ListTicketsResponse;
use Npl\Ticket\ViewFactory\TicketViewFactory;
use Npl\User\Entity\UserEntity;
use Npl\User\Exception\UserNotFoundException;
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
     * @param ListTicketsRequest  $request
     * @param ListTicketsResponse $response
     *
     * @return ListTicketsResponse
     * @throws UserNotFoundException
     */
    public function process(
        ListTicketsRequest $request,
        ListTicketsResponse $response
    ) {
        $user = $this->getUserFromRepository($request->getUserId());
        $this->addTicketsFromUserToResponse($user, $response);
        return $response;
    }

    /**
     * @param $userId
     *
     * @return UserEntity
     * @throws UserNotFoundException
     */
    private function getUserFromRepository($userId)
    {
        $user = $this->_userRepository->findById($userId);

        if (!$user) {
            throw new UserNotFoundException();
        }

        return $user;
    }

    /**
     * @param UserEntity          $userEntity
     * @param ListTicketsResponse $response
     *
     * @return ListTicketsResponse
     */
    private function addTicketsFromUserToResponse(UserEntity $userEntity, ListTicketsResponse $response)
    {
        $tickets = $this->_ticketRepository->findByUserId($userEntity->getId());

        foreach ($tickets as $ticket) {
            $ticketView = $this->_ticketViewFactory->create($ticket);
            $response->addTicket($ticketView);
        }

        return $response;
    }
}