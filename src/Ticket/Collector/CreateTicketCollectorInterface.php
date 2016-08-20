<?php

namespace Npl\Ticket\Collector;

interface CreateTicketCollectorInterface
{
    public function findLanById($lanId);
    public function findUserById($userId);
    public function findTicketsByLan($lanId);
    public function findTicketsByLanAndUser($lanId, $userId);
}