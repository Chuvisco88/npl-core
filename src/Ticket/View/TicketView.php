<?php

namespace Npl\Ticket\View;

/**
 * Class TicketView
 *
 * @package Npl\Ticket\View
 */
class TicketView
{
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
     * @return int
     */
    public function getBuyerId()
    {
        return $this->_buyerId;
    }

    /**
     * @param int $buyerId
     *
     * @return $this
     */
    public function setBuyerId($buyerId)
    {
        $this->_buyerId = $buyerId;
        return $this;
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
     * @return int
     */
    public function setHolderId($holderId)
    {
        $this->_holderId = $holderId;
        return $this->_holderId;
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