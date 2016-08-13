<?php

namespace Npl\Ticket\Entity;

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
     * @var int
     */
    private $_buyerId;

    /**
     * @var int
     */
    private $_holderId;

    /**
     * @var int
     */
    private $_lanId;

    /**
     * TicketEntity constructor.
     *
     * @param int $buyerId
     * @param int $lanId
     */
    public function __construct($buyerId, $lanId)
    {
        $this->_buyerId = $buyerId;
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
     * @return int
     */
    public function getBuyerId()
    {
        return $this->_buyerId;
    }

    /**
     * @return int
     */
    public function getHolderId()
    {
        return $this->_holderId;
    }

    /**
     * @param int $holderId
     *
     * @return $this
     */
    public function setHolderId($holderId)
    {
        $this->_holderId = $holderId;
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