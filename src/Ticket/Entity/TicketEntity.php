<?php

namespace Npl\Ticket\Entity;

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
     * @var int
     */
    private $_lanId;

    /**
     * TicketEntity constructor.
     *
     * @param UserEntity $buyer
     * @param int $lanId
     */
    public function __construct(UserEntity $buyer, $lanId)
    {
        $this->_buyer = $buyer;
        $this->_lanId = $lanId;
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
    public function getLanId()
    {
        return $this->_lanId;
    }

    /**
     * @param int $lanId
     *
     * @return $this
     */
    public function setLanId($lanId)
    {
        $this->_lanId = $lanId;
        return $this;
    }
}