<?php

namespace Npl\Ticket\Response;

use Npl\Ticket\View\TicketView;

/**
 * Interface ListTicketsResponseInterface
 *
 * @package Npl\Ticket\Response
 */
interface ListTicketsResponseInterface
{
    /**
     * @param TicketView $ticketView
     *
     * @return $this
     */
    public function addTicket(TicketView $ticketView);

    /**
     * @return array
     */
    public function getTickets();
}