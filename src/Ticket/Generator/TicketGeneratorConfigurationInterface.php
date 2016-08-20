<?php

namespace Npl\Ticket\Generator;

use Npl\Lan\Entity\LanEntity;
use Npl\User\Entity\UserEntity;

interface TicketGeneratorConfigurationInterface
{
    /**
     * @return UserEntity
     */
    public function getBuyer();

    /**
     * @return UserEntity
     */
    public function getHolder();

    /**
     * @return LanEntity
     */
    public function getLan();
}