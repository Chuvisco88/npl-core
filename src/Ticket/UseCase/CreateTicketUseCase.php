<?php

namespace Npl\Ticket\UseCase;

use Npl\Core\Util\DI;
use Npl\Lan\Exception\LanNotFoundException;
use Npl\Lan\Repository\LanRepositoryInterface;
use Npl\Ticket\Entity\TicketEntity;
use Npl\Ticket\Exception\TicketNotFoundException;
use Npl\Ticket\Repository\TicketRepositoryInterface;
use Npl\Ticket\Request\CreateTicketRequestInterface;
use Npl\Ticket\Response\CreateTicketResponseInterface;
use Npl\Ticket\ViewFactory\TicketViewFactoryInterface;
use Npl\User\Exception\UserNotFoundException;
use Npl\User\Repository\UserRepositoryInterface;

/**
 * Class CreateTicketUseCase
 *
 * @package Npl\Ticket\UseCase
 */
class CreateTicketUseCase
{
    /**
     * @var LanRepositoryInterface $_lanRepository
     */
    private $_lanRepository;
    /**
     * @var TicketRepositoryInterface $_ticketRepository
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
        LanRepositoryInterface $lanRepository,
        TicketRepositoryInterface $ticketRepository,
        TicketViewFactoryInterface $ticketViewFactory,
        UserRepositoryInterface $userRepository
    ) {
        $this->_lanRepository = $lanRepository;
        $this->_ticketRepository = $ticketRepository;
        $this->_ticketViewFactory = $ticketViewFactory;
        $this->_userRepository = $userRepository;
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
        $lan = $this->getLanFromRepository($request->getLanId());
        $user = $this->getUserFromRepository($request->getUserId());
        $ticket = new TicketEntity($user, $lan);
        $this->addTicketToResponse($ticket, $response);
        return $response;
    }

    private function getLanFromRepository($lanId)
    {
        return $this->_lanRepository->findById($lanId);
    }

    private function getUserFromRepository($userId)
    {
        return $this->_userRepository->findById($userId);
    }

    private function addTicketToResponse(TicketEntity $ticketEntity, CreateTicketResponseInterface $response)
    {
        $ticketView = $this->_ticketViewFactory->create($ticketEntity);
        $response->setTicket($ticketView);
    }
}