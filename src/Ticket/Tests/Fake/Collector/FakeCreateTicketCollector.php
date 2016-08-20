<?php

namespace Npl\Ticket\Tests\Fake\Collector;

use Npl\Lan\Repository\LanRepositoryInterface;
use Npl\Ticket\Collector\CreateTicketCollectorInterface;
use Npl\Ticket\Repository\TicketRepositoryInterface;
use Npl\User\Repository\UserRepositoryInterface;

class FakeCreateTicketCollector implements CreateTicketCollectorInterface
{
    private $_lanRepository;
    private $_ticketRepository;
    private $_userRepository;

    public function __construct(
        LanRepositoryInterface $lanRepository,
        TicketRepositoryInterface $ticketRepository,
        UserRepositoryInterface $userRepository
    ) {
        $this->_lanRepository = $lanRepository;
        $this->_ticketRepository = $ticketRepository;
        $this->_userRepository = $userRepository;
    }

    public function findLanById($lanId)
    {
        return $this->_lanRepository->findById($lanId);
    }

    public function findUserById($userId)
    {
        return $this->_userRepository->findById($userId);
    }

    public function findTicketsByLan($lanId)
    {
        // TODO: Implement findTicketsByLan() method.
    }

    public function findTicketsByLanAndUser($lanId, $userId)
    {
        return $this->_ticketRepository->findByLanIdAndUserId($lanId, $userId);
    }

}