<?php

namespace Npl\Ticket\Tests\Fake\Request;

use Npl\Ticket\Request\ListTicketsRequestInterface;

/**
 * Class FakeListTicketsRequest
 *
 * @package Npl\Ticket\Tests\Fake\Request
 */
class FakeListTicketsRequest implements ListTicketsRequestInterface
{
    /**
     * @var int
     */
    private $_userId;

    /**
     * FakeListTicketsRequest constructor.
     *
     * @param int $userId
     */
    public function __construct($userId)
    {
        $this->_userId = $userId;
    }

    /**
     * @return int
     */
    public function getUserId()
    {
        return $this->_userId;
    }
}