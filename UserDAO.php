<?php

require_once 'admin/server/model/Utility.php';
require_once 'admin/server/model/Dbh.php';
require_once 'User.php';

class UserDAO extends Utility
{


     // mostly used for select queries, mapping results to a model
     function query($sql)
     {
         $db = Dbh::getInstance();
         $stmt = $db->prepare($sql);
         $stmt->execute();
 
         $user = array();
         while ($row = $stmt->fetch(PDO::FETCH_ASSOC)) {
             $user[] = new User(
                 $row["customerId"],
                 $row["username"],
                 $row["password"],
                 $row["email"]
             );
         }
         $stmt = null;
         return $user;
     }

    function getUserByUsername($username)
    {
        $username_ = $this->stringValue($username);
        $sql = "SELECT\n"
            . " *\n"
            . "FROM\n"
            . " `customer`\n"
            . "WHERE\n"
            . " username = $username_";

        return $this->query($sql);
    }


    // create new customer - good enough
    function create($username, $email, $password)
    {
        $_username = $this->stringValue($username);
        $_email = $this->stringValue($email);
        $_password = $this->stringValue($password);

        $sql = "INSERT\n"
            . "INTO\n"
            . " customer(username,\n"
            . " password,\n"
            . " email)\n"
            . "VALUES($_username, $_password, $_email)";
        $db = Dbh::getInstance();
        $stmt = $db->prepare($sql);
        $stmt->execute();
        return $stmt;
    }


    // create new customer - good enough
    function createOrder($username, $carId,$address)
    {
        $results = $this->getUserByUsername($username);
        $_id = $results[0]->getUserId();
        $_carId = $this->stringValue($carId);
        $_address = $this->stringValue($address);

        $sql = "INSERT\n"
            . "INTO\n"
            . " customerorder(customerId,\n"
            . " vehicleId,address)\n"
            . "VALUES($_id, $_carId,$_address)";
        $db = Dbh::getInstance();
        $stmt = $db->prepare($sql);
        $stmt->execute();
        return $stmt;
    }

    // redirect 404 if users trying to access a non-existing user
    function redirectNotFoundUser($request_username)
    {
        if (!empty($request_username)) {
            if (count($this->getUserByUsername($request_username)) > 0) {
                header("Location:not-found.php");
            }
        }
    }

}