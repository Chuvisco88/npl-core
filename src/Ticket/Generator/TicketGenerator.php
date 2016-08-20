<?php

namespace Npl\Ticket\Generator;

use Npl\Core\Generator\GeneratorInterface;
use Npl\Ticket\Entity\TicketEntity;

class TicketGenerator implements GeneratorInterface
{
    private $_lan;
    private $_buyer;
    private $_holder;
    private $_numberOfTickets;

    public function __construct(TicketGeneratorConfigurationInterface $ticketConfiguration, $numberOfTickets = 0)
    {
        $this->_lan = $ticketConfiguration->getLan();
        $this->_buyer = $ticketConfiguration->getBuyer();
        $this->_holder = $ticketConfiguration->getHolder();
        $this->_numberOfTickets = $numberOfTickets;
    }

    /**
     * @return TicketEntity[]
     */
    public function generate()
    {
        $tickets = [];

        for ($ticketId = 1; $ticketId <= $this->_numberOfTickets; $ticketId++) {
            $ticket = new TicketEntity($this->_buyer, $this->_lan, $this->_holder);
            $ticket->setId($ticketId);
            $tickets[] = $ticket;
        }

        return $tickets;
    }
}