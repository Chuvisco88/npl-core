<?php

namespace Npl\Lan\Tests\Fake\Repository;

use Npl\Lan\Entity\LanEntity;
use Npl\Lan\Exception\LanNotFoundException;
use Npl\Lan\Repository\LanRepositoryInterface;

class FakeLanRepository implements LanRepositoryInterface
{
    /**
     * @var array
     */
    private $_lans = [];

    /**
     * FakeLanRepository constructor.
     *
     * @param array $lans
     */
    public function __construct(array $lans = [])
    {
        $this->_lans = $lans;
    }

    /**
     * @param $lanId
     *
     * @return LanEntity
     * @throws LanNotFoundException
     */
    public function findById($lanId)
    {
        foreach ($this->_lans as $lan) {
            if ($lan->getId() === $lanId) {
                return $lan;
            }
        }

        throw new LanNotFoundException();
    }

}