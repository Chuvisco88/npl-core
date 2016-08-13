<?php

namespace Npl\Ticket\Tests\Fake\Request;

use Npl\Ticket\Request\ViewTicketRequestInterface;

/**
 * Class FakeViewTicketRequest
 *
 * @package Npl\Ticket\Tests\Fake\Request
 */
class FakeViewTicketRequest implements ViewTicketRequestInterface
{
    /**
     * @var int
     */
    private $_ticketId;

    /**
     * FakeViewTicketRequest constructor.
     *
     * @param int $ticketId
     */
    public function __construct($ticketId)
    {
        $this->_ticketId = $ticketId;
    }

    /**
     * @return int
     */
    public function getTicketId()
    {
        return $this->_ticketId;
    }
}