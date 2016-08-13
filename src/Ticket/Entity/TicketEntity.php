<?php

namespace Npl\Ticket\Entity;

use Npl\Lan\Entity\LanEntity;
use Npl\User\Entity\UserEntity;

/**
 * Class TicketEntity
 *
 * @package Npl\Ticket\Entity
 */
class TicketEntity
{
    /**
     * @var int
     */
    private $_id;

    /**
     * @var UserEntity
     */
    private $_buyer;

    /**
     * @var UserEntity
     */
    private $_holder;

    /**
     * @var LanEntity
     */
    private $_lan;

    /**
     * TicketEntity constructor.
     *
     * @param UserEntity      $buyer
     * @param LanEntity       $lan
     * @param UserEntity|null $holder
     */
    public function __construct(UserEntity $buyer, LanEntity $lan, UserEntity $holder = null)
    {
        $this->_buyer = $buyer;
        $this->_lan = $lan;
        $this->_holder = null === $holder ? $buyer : $holder;
    }

    /**
     * @return int
     */
    public function getId()
    {
        return $this->_id;
    }

    /**
     * @param int $id
     *
     * @return $this
     */
    public function setId($id)
    {
        $this->_id = $id;
        return $this;
    }

    /**
     * @return UserEntity
     */
    public function getBuyer()
    {
        return $this->_buyer;
    }

    /**
     * @return UserEntity
     */
    public function getHolder()
    {
        return $this->_holder;
    }

    /**
     * @param UserEntity $holder
     *
     * @return $this
     */
    public function setHolder(UserEntity $holder)
    {
        $this->_holder = $holder;
        return $this;
    }

    /**
     * @return int
     */
    public function getLan()
    {
        return $this->_lan;
    }

    /**
     * @param LanEntity $lanEntity
     *
     * @return $this
     */
    public function setLan(LanEntity $lanEntity)
    {
        $this->_lan = $lanEntity;
        return $this;
    }
}