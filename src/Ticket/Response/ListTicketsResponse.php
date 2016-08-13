<?php

namespace Npl\Ticket\Response;

use Npl\Ticket\View\TicketView;

/**
 * Interface ListTicketsResponse
 *
 * @package Npl\Ticket\Response
 */
interface ListTicketsResponse
{
    /**
     * @param TicketView $ticketView
     *
     * @return mixed
     */
    public function addTicket(TicketView $ticketView);

    /**
     * @return mixed
     */
    public function getTickets();
}