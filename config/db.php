<?php

function getConnection() {
    $con = mysqli_connect("localhost", "root", "", "bookstore");

    if(!$con) {
        die("Database connection failed");
    }

    return $con;
}
?>