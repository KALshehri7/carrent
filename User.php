<?php

class User
{
    private $userId;
    private $username;
    private $password;
    private $email;

    public function __construct($user_id, $username, $password, $email)
    {
        $this->user_id = $user_id;
        $this->username = $username;
        $this->password = $password;
        $this->email = $email;
    }

    public function setUserId($user_id)
    {
        $this->user_id = $user_id;
    }

    public function setUsername($username)
    {
        $this->username = $username;
    }

    public function setPassword($password)
    {
        $this->password = $password;
    }

    public function setEmail($email)
    {
        $this->email = $email;
    }


    public function getUserId()
    {
        return $this->user_id;
    }

    public function getUsername()
    {
        return $this->username;
    }

    public function getPassword()
    {
        return $this->password;
    }

    public function getEmail()
    {
        return $this->email;
    }

    function __toString()
    {
        $out = "";
        $out .= 'id ' . $this->userId . "\n";
        $out .= 'username ' . $this->username . "\n";
        $out .= 'password ' . $this->password . "\n";
        $out .= 'email ' . $this->email . "\n";
        return $out;
    }

}