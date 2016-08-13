<?php

namespace Npl\Ticket\UseCase;

use Npl\Ticket\Repository\TicketRepositoryInterface;
use Npl\Ticket\Request\ListTicketsRequestInterface;
use Npl\Ticket\Response\ListTicketsResponseInterface;
use Npl\Ticket\ViewFactory\TicketViewFactoryInterface;
use Npl\User\Entity\UserEntity;
use Npl\User\Exception\UserNotFoundException;
use Npl\User\Repository\UserRepositoryInterface;

/**
 * Class ListTicketsUseCase
 *
 * @package Npl\Ticket\UseCase
 */
class ListTicketsUseCase
{
    /**
     * @var TicketRepositoryInterface
     */
    private $_ticketRepository;
    /**
     * @var TicketViewFactoryInterface
     */
    private $_ticketViewFactory;
    /**
     * @var UserRepositoryInterface
     */
    private $_userRepository;

    public function __construct(
        TicketRepositoryInterface $ticketRepository,
        TicketViewFactoryInterface $ticketViewFactory,
        UserRepositoryInterface $userRepository
    ) {
        $this->_ticketRepository = $ticketRepository;
        $this->_ticketViewFactory = $ticketViewFactory;
        $this->_userRepository = $userRepository;
    }

    /**
     * @param ListTicketsRequestInterface  $request
     * @param ListTicketsResponseInterface $response
     *
     * @return ListTicketsResponseInterface
     * @throws UserNotFoundException
     */
    public function process(
        ListTicketsRequestInterface $request,
        ListTicketsResponseInterface $response
    ) {
        $user = $this->getUserFromRepository($request->getUserId());
        $tickets = $this->getTicketsFromRepositoryByUser($user);
        $this->addTicketsFromUserToResponse($tickets, $response);
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
     * @param UserEntity $userEntity
     *
     * @return array
     */
    private function getTicketsFromRepositoryByUser(UserEntity $userEntity)
    {
        return $this->_ticketRepository->findByUserId($userEntity->getId());
    }

    /**
     * @param array                        $tickets
     * @param ListTicketsResponseInterface $response
     *
     * @return ListTicketsResponseInterface
     */
    private function addTicketsFromUserToResponse(array $tickets, ListTicketsResponseInterface $response)
    {
        foreach ($tickets as $ticket) {
            $ticketView = $this->_ticketViewFactory->create($ticket);
            $response->addTicket($ticketView);
        }

        return $response;
    }
}