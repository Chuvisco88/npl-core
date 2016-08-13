<?php

namespace Npl\Lan\Repository;

use Npl\Lan\Entity\LanEntity;
use Npl\Lan\Exception\LanNotFoundException;

/**
 * Interface LanRepositoryInterface
 *
 * @package Npl\Ticket\Repository
 */
interface LanRepositoryInterface
{
    /**
     * @param $lanId
     *
     * @return LanEntity
     * @throws LanNotFoundException
     */
    public function findById($lanId);
}