<?php

namespace Npl\Ticket\ViewFactory;

use Npl\Ticket\Entity\TicketEntity;

/**
 * Interface TicketViewFactoryInterface
 *
 * @package Npl\Ticket\ViewFactory
 */
interface TicketViewFactoryInterface
{
    /**
     * @param TicketEntity $ticket
     *
     * @return $this
     */
    public function create(TicketEntity $ticket);
}