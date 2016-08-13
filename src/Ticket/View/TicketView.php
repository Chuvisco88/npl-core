<?php

namespace Npl\Ticket\View;

/**
 * Class TicketView
 *
 * @package Npl\Ticket\View
 */
class TicketView implements TicketViewInterface
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
     * @var string
     */
    private $_lanName;

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
     * @return string
     */
    public function getLanName()
    {
        return $this->_lanName;
    }

    /**
     * @param string $lanName
     *
     * @return $this
     */
    public function setLanName($lanName)
    {
        $this->_lanName = $lanName;
        return $this;
    }
}