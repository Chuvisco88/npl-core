<?php

namespace Npl\Ticket\Tests\Fake\Repository;

use Npl\Lan\Entity\LanEntity;
use Npl\Ticket\Entity\TicketEntity;
use Npl\Ticket\Exception\TicketNotFoundException;
use Npl\Ticket\Repository\TicketRepositoryInterface;
use Npl\User\Entity\UserEntity;

/**
 * Class FakeTicketRepository
 *
 * @package Npl\Ticket\Tests\Fake\Repository
 */
class FakeTicketRepository implements TicketRepositoryInterface
{
    /**
     * @var TicketEntity[]
     */
    private $_tickets = [];

    /**
     * FakeTicketRepository constructor.
     *
     * @param int             $numberOfTickets
     * @param LanEntity|null  $lanEntity
     * @param UserEntity|null $buyer
     * @param UserEntity|null $holder
     */
    public function __construct($numberOfTickets = 0, LanEntity $lanEntity = null, UserEntity $buyer = null, UserEntity $holder = null)
    {
        if ($numberOfTickets > 0 && (null === $lanEntity || null === $buyer)) {
            throw new \InvalidArgumentException('You wanted tickets to be generated but did not specify the user and lan.');
        }
        for ($ticketId = 1; $ticketId <= $numberOfTickets; $ticketId++) {
            $ticket = new TicketEntity($buyer, $lanEntity, $holder);
            $ticket->setId($ticketId);
            $this->_tickets[] = $ticket;
        }
    }

    /**
     * @param $ticketId
     *
     * @return TicketEntity
     * @throws TicketNotFoundException
     */
    public function findById($ticketId)
    {
        foreach ($this->_tickets as $ticket) {
            if ($ticket->getId() === $ticketId) {
                return $ticket;
            }
        }

        throw new TicketNotFoundException();
    }

    /**
     * @param $userId
     *
     * @return TicketEntity[]
     */
    public function findByUserId($userId)
    {
        return $this->_tickets;
    }
}