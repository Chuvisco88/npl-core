<?php

namespace Npl\Ticket\ViewFactory;

use Npl\Ticket\Entity\TicketEntity;
use Npl\Ticket\View\TicketViewInterface;

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
     * @return TicketViewInterface
     */
    public function create(TicketEntity $ticket);
}