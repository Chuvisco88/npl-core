<?php

namespace Npl\Ticket\Repository;

/**
 * Interface TicketRepositoryInterface
 *
 * @package Npl\Ticket\Repository
 */
interface TicketRepositoryInterface
{
    /**
     * @param $userId
     *
     * @return array
     */
    public function findByUserId($userId);
}