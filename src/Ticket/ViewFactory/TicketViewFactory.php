<?php

namespace Npl\Ticket\ViewFactory;

use Npl\Ticket\Entity\TicketEntity;

/**
 * Interface TicketViewFactory
 *
 * @package Npl\Ticket\ViewFactory
 */
interface TicketViewFactory
{
    /**
     * @param TicketEntity $ticket
     *
     * @return mixed
     */
    public function create(TicketEntity $ticket);
}