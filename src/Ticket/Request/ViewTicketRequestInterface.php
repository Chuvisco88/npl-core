<?php

namespace Npl\Ticket\Request;

/**
 * Interface ViewTicketRequestInterface
 *
 * @package Npl\Ticket\Request
 */
interface ViewTicketRequestInterface
{
    /**
     * ViewTicketRequestInterface constructor.
     *
     * @param $ticketId
     */
    public function __construct($ticketId);

    /**
     * @return int
     */
    public function getTicketId();
}