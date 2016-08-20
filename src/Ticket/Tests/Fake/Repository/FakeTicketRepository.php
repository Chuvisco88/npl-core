<?php

namespace Npl\Ticket\Tests\Fake\Repository;

use Npl\Ticket\Entity\TicketEntity;
use Npl\Ticket\Exception\TicketNotFoundException;
use Npl\Ticket\Repository\TicketRepositoryInterface;

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
     * @param TicketEntity[] $tickets
     */
    public function __construct(array $tickets = [])
    {
        $this->_tickets = $tickets;
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

    public function findByLanIdAndUserId($lanId, $userId)
    {
        $tickets = [];

        foreach ($this->_tickets as $ticket) {
            $buyer = $ticket->getBuyer();
            $lan = $ticket->getLan();

            if ($lan->getId() === $lanId && $buyer->getId() === $userId) {
                $tickets[] = $ticket;
            }
        }

        return $tickets;
    }
}