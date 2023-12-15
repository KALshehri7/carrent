<?php

require_once 'model/Utility.php';
require_once 'model/Dbh.php';
require_once 'model/CarDealer.php';

class CarDealerDAO extends Utility
{

    // mostly used for select queries, mapping results to a model
    function query($sql)
    {
        $db = Dbh::getInstance();
        $stmt = $db->prepare($sql);
        $stmt->execute();

        $carDealer = array();
        while ($row = $stmt->fetch(PDO::FETCH_ASSOC)) {
            $carDealer[] = new carDealer(
                $row["cardealerId"],
                $row["username"],
                $row["password"],
                $row["email"],
                $row["admin_id"]
            );
        }
        $stmt = null;
        return $carDealer;
    }

    

    function getCarDealerByUsername($username)
    {
        $username_ = $this->stringValue($username);
        $sql = "SELECT\n"
            . " *\n"
            . "FROM\n"
            . " `cardealer`\n"
            . "WHERE\n"
            . " username = $username_";

        return $this->query($sql);
    }

    /**
     * I'm only updating 2 elements here
     * tested
     */
    function update(&$cardealer)
    {
        $_password = $this->stringValue($cardealer->getPassword());
        $sql = "UPDATE\n"
            . " `cardealer`\n"
            . "SET\n"
            . " `password` = $_password\n"
            . "WHERE\n"
            . " `username` = '" . $cardealer->getUsername()."'";
        $db = Dbh::getInstance();
        $stmt = $db->prepare($sql);
        $stmt->execute();
        return $stmt->rowCount();
    }


    // redirect 404 if users trying to access a non-existing car dealker
    function redirectNotFoundCarDealer($request_username)
    {
        if (!empty($request_username)) {
            if (count($this->getCarDealerByUsername($request_username)) > 0) {
                header("Location:not-found.php");
            }
        }
    }

}