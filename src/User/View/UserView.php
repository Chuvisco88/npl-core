<?php

namespace Npl\User\View;

/**
 * Class UserView
 *
 * @package Npl\User\View
 */
class UserView
{
    /**
     * @var string
     */
    protected $_email;
    /**
     * @var string
     */
    protected $_nickname;

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