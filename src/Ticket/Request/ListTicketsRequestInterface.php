<?php

namespace Npl\Ticket\Request;

/**
 * Interface ListTicketsRequestInterface
 *
 * @package Npl\Ticket\Request
 */
interface ListTicketsRequestInterface
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