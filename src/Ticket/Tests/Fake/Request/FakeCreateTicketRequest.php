<?php

namespace Npl\Ticket\Tests\Fake\Request;

use Npl\Ticket\Request\CreateTicketRequestInterface;

/**
 * Class FakeCreateTicketRequest
 *
 * @package Npl\Ticket\Tests\Fake\Request
 */
class FakeCreateTicketRequest implements CreateTicketRequestInterface
{
    /**
     * @var int
     */
    private $_lanId;

    /**
     * @var int
     */
    private $_userId;

    /**
     * FakeCreateTicketRequest constructor.
     *
     * @param int $lanId
     * @param int $userId
     */
    public function __construct($lanId, $userId)
    {
        $this->_lanId = $lanId;
        $this->_userId = $userId;
    }

    /**
     * @return int
     */
    public function getLanId()
    {
        return $this->_lanId;
    }

    /**
     * @return int
     */
    public function getUserId()
    {
        return $this->_userId;
    }
}