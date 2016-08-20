<?php

namespace Npl\Ticket\Tests\Fake\Generator;

use Npl\Lan\Entity\LanEntity;
use Npl\Ticket\Generator\TicketGeneratorConfigurationInterface;
use Npl\User\Entity\UserEntity;

class FakeTicketGeneratorConfiguration implements TicketGeneratorConfigurationInterface
{
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

    public function __construct(UserEntity $buyer, LanEntity $lan, UserEntity $holder = null)
    {
        $this->_buyer = $buyer;
        $this->_lan = $lan;
        $this->_holder = null === $holder ? $buyer : $holder;
    }

    public function getBuyer()
    {
        return $this->_buyer;
    }

    public function getHolder()
    {
        return $this->_holder;
    }

    public function getLan()
    {
        return $this->_lan;
    }
}