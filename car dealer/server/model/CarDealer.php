<?php

class CarDealer
{
    private $carDealerId;
    private $username;
    private $password;
    private $email;
    private $admin_id;

    public function __construct($carDealer_id, $username, $password, $email, $admin_id)
    {
        $this->carDealerId = $carDealer_id;
        $this->username = $username;
        $this->password = $password;
        $this->email = $email;
        $this->admin_id = $admin_id;
    }

    public function setCarDealerId($carDealer_id)
    {
        $this->carDealerId = $carDealer_id;
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

    public function setAdminID($admin_id)
    {
        $this->admin_id = $admin_id;
    }

    
    public function getCarDealerId()
    {
        return $this->carDealerId;
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

    public function getAdminID()
    {
        return $this->admin_id;
    }


    function __toString()
    {
        $out = "";
        $out .= 'id ' . $this->carDealerId . "\n";
        $out .= 'username ' . $this->username . "\n";
        $out .= 'password ' . $this->password . "\n";
        $out .= 'email ' . $this->email . "\n";
        $out .= 'admin_id ' . $this->admin_id . "\n";
        return $out;
    }

}