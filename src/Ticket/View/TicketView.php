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
     * @var string
     */
    private $_buyerName;
    /**
     * @var string
     */
    private $_holderName;
    /**
     * @var int
     */
    private $_lanId;

    /**
     * @return string
     */
    public function getBuyerName()
    {
        return $this->_buyerName;
    }

    /**
     * @param string $buyerName
     *
     * @return $this
     */
    public function setBuyerName($buyerName)
    {
        $this->_buyerName = $buyerName;
        return $this;
    }

    /**
     * @return string
     */
    public function getHolderName()
    {
        return $this->_holderName;
    }

    /**
     * @param string $holderName
     *
     * @return $this
     */
    public function setHolderName($holderName)
    {
        $this->_holderName = $holderName;
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