<?php

namespace Npl\Ticket\Repository;

/**
 * Interface TicketRepository
 *
 * @package Npl\Ticket\Repository
 */
interface TicketRepository
{
    /**
     * @param $userId
     *
     * @return array
     */
    public function findByUserId($userId);
}