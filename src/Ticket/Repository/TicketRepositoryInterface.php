<?php

namespace Npl\Ticket\Repository;

use Npl\Ticket\Entity\TicketEntity;
use Npl\Ticket\Exception\TicketNotFoundException;

/**
 * Interface TicketRepositoryInterface
 *
 * @package Npl\Ticket\Repository
 */
interface TicketRepositoryInterface
{
    /**
     * @param $ticketId
     *
     * @return TicketEntity
     * @throws TicketNotFoundException
     */
    public function findById($ticketId);

    /**
     * @param $userId
     *
     * @return TicketEntity[]
     */
    public function findByUserId($userId);
}