<?php

$host = "localhost";
$user = "root";
$password = "";
$database = "online_book_store";

function getConnection()
{
    global $host;
    global $user;
    global $password;
    global $database;

    $conn = mysqli_connect($host, $user, $password, $database);

    if (!$conn) {
        die("Database connection failed!");
    }

    return $conn;
}

?>