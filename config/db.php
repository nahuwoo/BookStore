<?php
    $host = "127.0.0.1";
    $dbuser = "root";
    $dbname = "bookstore";
    $dbpass = "";

    function getConnection(){
        global $host, $dbuser, $dbname, $dbpass;
        $con = mysqli_connect($host, $dbuser, $dbpass, $dbname);
        if(!$con){
        die("Connection failed: " . mysqli_connect_error());
        }
        return $con;
    }
?>
