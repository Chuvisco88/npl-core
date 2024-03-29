<?php

namespace Npl\Ticket\Tests\Fake\ViewFactory;

use Npl\Ticket\Entity\TicketEntity;
use Npl\Ticket\View\TicketView;
use Npl\Ticket\ViewFactory\TicketViewFactoryInterface;

/**
 * Class FakeTicketViewFactory
 *
 * @package Npl\Ticket\Tests\Fake\ViewFactory
 */
class FakeTicketViewFactory implements TicketViewFactoryInterface
{
    /**
     * @param TicketEntity $ticket
     *
     * @return TicketView
     */
    public function create(TicketEntity $ticket)
    {
        $ticketView = new TicketView();
        $ticketView->setBuyerName($ticket->getBuyer()->getNickname());
        $ticketView->setHolderName($ticket->getHolder()->getNickname());
        $ticketView->setLanName($ticket->getLan()->getName());
        return $ticketView;
    }
}