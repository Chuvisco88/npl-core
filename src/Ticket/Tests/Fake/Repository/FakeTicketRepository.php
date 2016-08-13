<?php

namespace Npl\Ticket\Tests\Fake\Repository;

use Npl\Ticket\Repository\TicketRepository;

/**
 * Class FakeTicketRepository
 *
 * @package Npl\Ticket\Tests\Fake\Repository
 */
class FakeTicketRepository implements TicketRepository
{
    /**
     * @var array
     */
    private $_tickets = [];

    /**
     * FakeTicketRepository constructor.
     *
     * @param array $tickets
     */
    public function __construct(array $tickets = [])
    {
        $this->_tickets = $tickets;
    }

    /**
     * @param $userId
     *
     * @return array
     */
    public function findByUserId($userId)
    {
        return $this->_tickets;
    }
}