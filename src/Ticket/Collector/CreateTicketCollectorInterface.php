<?php

namespace Npl\Ticket\Collector;

use Npl\Lan\Entity\LanEntity;
use Npl\Lan\Exception\LanNotFoundException;
use Npl\Ticket\Entity\TicketEntity;
use Npl\User\Entity\UserEntity;
use Npl\User\Exception\UserNotFoundException;

interface CreateTicketCollectorInterface
{
    /**
     * @param $lanId
     *
     * @return LanEntity
     * @throws LanNotFoundException
     */
    public function findLanById($lanId);

    /**
     * @param $userId
     *
     * @return UserEntity
     * @throws UserNotFoundException
     */
    public function findUserById($userId);

    /**
     * @param $lanId
     *
     * @return TicketEntity[]
     */
    public function findTicketsByLan($lanId);

    /**
     * @param $lanId
     * @param $userId
     *
     * @return TicketEntity[]
     */
    public function findTicketsByLanAndUser($lanId, $userId);
}