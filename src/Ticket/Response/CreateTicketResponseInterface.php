<?php

namespace Npl\Ticket\Response;

use Npl\Ticket\View\TicketView;

/**
 * Interface CreateTicketResponseInterface
 *
 * @package Npl\Ticket\Response
 */
interface CreateTicketResponseInterface
{
    /**
     * @param TicketView $ticketView
     *
     * @return $this
     */
    public function setTicket(TicketView $ticketView);

    /**
     * @return string
     */
    public function getBuyerName();

    /**
     * @return string
     */
    public function getHolderName();

    /**
     * @return string
     */
    public function getLanName();
}