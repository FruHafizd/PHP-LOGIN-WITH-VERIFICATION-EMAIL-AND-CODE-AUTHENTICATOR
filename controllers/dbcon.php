<?php

class dbcon 
{
    public function ConnectionDatabase()
    {
        $servername = "localhost";
        $username = "root";
        $password = "root";
        $db = "dummyloginphp";

        // Create connection
        $con = mysqli_connect($servername, $username, $password, $db);

        // Check connection
        if (!$con) {
            die("Connection failed: " . mysqli_connect_error());
        }

        return $con; // Return the connection
    }
}


// $cetakProduk = new dbcon();
// $cetakProduk->ConnectionDatabase();
// echo $cetakProduk;

