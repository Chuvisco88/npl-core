<?php

namespace Npl\User\View;

class UserView
{
    protected $_email;
    protected $_nickname;

    public function getEmail()
    {
        return $this->_email;
    }

    public function setEmail($email)
    {
        $this->_email = $email;
        return $this;
    }

    public function getNickname()
    {
        return $this->_nickname;
    }

    public function setNickname($nickname)
    {
        $this->_nickname = $nickname;
        return $this;
    }
}