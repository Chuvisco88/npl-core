<?php

namespace Npl\Lan\Entity;

/**
 * Class LanEntity
 *
 * @package Npl\Lan\Entity
 */
class LanEntity
{
    /**
     * @var string
     */
    private $_name;
    /**
     * @var \DateTime
     */
    private $_startDatetime;
    /**
     * @var \DateTime
     */
    private $_endDatetime;

    /**
     * LanEntity constructor.
     *
     * @param           $name
     * @param \DateTime $startDatetime
     * @param \DateTime $endDatetime
     * @throws \InvalidArgumentException
     */
    public function __construct($name, \DateTime $startDatetime, \DateTime $endDatetime)
    {
        if ($startDatetime >= $endDatetime) {
            throw new \InvalidArgumentException('Start datetime must be earlier than end datetime');
        }

        $this->_name = $name;
        $this->_startDatetime = $startDatetime;
        $this->_endDatetime = $endDatetime;
    }

    /**
     * @return string
     */
    public function getName()
    {
        return $this->_name;
    }

    /**
     * @return \DateTime
     */
    public function getStartDatetime()
    {
        return $this->_startDatetime;
    }

    /**
     * @return \DateTime
     */
    public function getEndDatetime()
    {
        return $this->_endDatetime;
    }


}