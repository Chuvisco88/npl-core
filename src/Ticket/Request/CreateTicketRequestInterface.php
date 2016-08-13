<?php

namespace Npl\Ticket\Request;

/**
 * Interface CreateTicketRequestInterface
 *
 * @package Npl\Ticket\Request
 */
interface CreateTicketRequestInterface
{
    /**
     * CreateTicketRequestInterface constructor.
     *
     * @param $lanId
     * @param $userId
     */
    public function __construct($lanId, $userId);

    /**
     * @return int
     */
    public function getLanId();

    /**
     * @return int
     */
    public function getUserId();
}