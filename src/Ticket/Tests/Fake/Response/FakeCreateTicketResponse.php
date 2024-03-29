<?php

namespace Npl\Ticket\Tests\Fake\Response;

use Npl\Ticket\Response\CreateTicketResponseInterface;
use Npl\Ticket\View\TicketView;

/**
 * Class FakeCreateTicketResponse
 *
 * @package Npl\Ticket\Tests\Fake\Response
 */
class FakeCreateTicketResponse implements CreateTicketResponseInterface
{
    /**
     * @var TicketView
     */
    private $_ticketView;

    /**
     * @param TicketView $ticketView
     *
     * @return $this
     */
    public function setTicket(TicketView $ticketView)
    {
        $this->_ticketView = $ticketView;
        return $this;
    }

    public function getBuyerName()
    {
        return $this->_ticketView->getBuyerName();
    }

    public function getHolderName()
    {
        return $this->_ticketView->getHolderName();
    }

    public function getLanName()
    {
        return $this->_ticketView->getLanName();
    }

}