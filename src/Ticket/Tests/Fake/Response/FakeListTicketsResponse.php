<?php

namespace Npl\Ticket\Tests\Fake\Response;

use Npl\Ticket\Response\ListTicketsResponseInterface;
use Npl\Ticket\View\TicketView;

/**
 * Class FakeListTicketsResponse
 *
 * @package Npl\Ticket\Tests\Fake\Response
 */
class FakeListTicketsResponse implements ListTicketsResponseInterface
{
    /**
     * @var array
     */
    private $_ticketViews = [];

    /**
     * @param TicketView $ticketView
     *
     * @return $this
     */
    public function addTicket(TicketView $ticketView)
    {
        $this->_ticketViews[] = $ticketView;
        return $this;
    }

    /**
     * @return array
     */
    public function getTickets()
    {
        return $this->_ticketViews;
    }
}