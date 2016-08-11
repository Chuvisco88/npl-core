<?php

namespace Npl\User\Entity;

class UserEntity
{
    private $_email;
    private $_nickname;

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
