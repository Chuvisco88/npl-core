<?php

namespace Npl\Ticket\Request;

/**
 * Interface ListTicketsRequest
 *
 * @package Npl\Ticket\Request
 */
interface ListTicketsRequest
{
    /**
     * ListTicketsRequest constructor.
     *
     * @param int $userId
     */
    public function __construct($userId);

    /**
     * @return int
     */
    public function getUserId();
}