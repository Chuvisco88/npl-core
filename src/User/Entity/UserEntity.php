<?php

namespace Npl\User\Entity;

/**
 * Class UserEntity
 *
 * @package Npl\User\Entity
 */
class UserEntity
{
    /**
     * @var string
     */
    private $_email;
    /**
     * @var string
     */
    private $_nickname;

    /**
     * @return string
     */
    public function getEmail()
    {
        return $this->_email;
    }

    /**
     * @param string $email
     *
     * @return $this
     */
    public function setEmail($email)
    {
        $this->_email = $email;
        return $this;
    }

    /**
     * @return string
     */
    public function getNickname()
    {
        return $this->_nickname;
    }

    /**
     * @param string $nickname
     *
     * @return $this
     */
    public function setNickname($nickname)
    {
        $this->_nickname = $nickname;
        return $this;
    }
}
