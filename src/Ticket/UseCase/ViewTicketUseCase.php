<?php

namespace Npl\Ticket\UseCase;

use Npl\Ticket\Entity\TicketEntity;
use Npl\Ticket\Exception\TicketNotFoundException;
use Npl\Ticket\Repository\TicketRepositoryInterface;
use Npl\Ticket\Request\ViewTicketRequestInterface;
use Npl\Ticket\Response\ViewTicketResponseInterface;
use Npl\Ticket\Tests\Fake\Response\FakeViewTicketResponse;
use Npl\Ticket\View\TicketView;
use Npl\Ticket\ViewFactory\TicketViewFactoryInterface;

/**
 * Class ViewTicketUseCase
 *
 * @package Npl\Ticket\UseCase
 */
class ViewTicketUseCase
{
    /**
     * @var TicketRepositoryInterface
     */
    private $_ticketRepository;
    /**
     * @var TicketViewFactoryInterface
     */
    private $_ticketViewFactory;

    public function __construct(
        TicketRepositoryInterface $ticketRepository,
        TicketViewFactoryInterface $ticketViewFactory
    ) {
        $this->_ticketRepository = $ticketRepository;
        $this->_ticketViewFactory = $ticketViewFactory;
    }

    /**
     * @param ViewTicketRequestInterface  $request
     * @param ViewTicketResponseInterface $response
     *
     * @return ViewTicketResponseInterface
     * @throws TicketNotFoundException
     */
    public function process(
        ViewTicketRequestInterface $request,
        ViewTicketResponseInterface $response
    ) {
        $ticket = $this->getTicketFromRepository($request->getTicketId());
        $this->addTicketToResponse($ticket, $response);
        return $response;
    }

    private function getTicketFromRepository($ticketId)
    {
        return $this->_ticketRepository->findById($ticketId);
    }

    private function addTicketToResponse(TicketEntity $ticketEntity, ViewTicketResponseInterface $response)
    {
        $ticketView = $this->_ticketViewFactory->create($ticketEntity);
        $response->setTicket($ticketView);
    }
}