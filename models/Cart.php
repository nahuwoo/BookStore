<?php
require_once('../config/db.php');

function getCartItems($user_id) {
    $con = getConnection();
    $sql = "SELECT cart.*, books.title, books.price FROM cart JOIN books ON cart.book_id = books.id WHERE cart.user_id='$user_id'";
    $res = mysqli_query($con, $sql);
    $items = [];

    while($row = mysqli_fetch_assoc($res)) {
        $items[] = $row;
    }
    return $items;
}

function addToCart($user_id, $book_id, $qty) {
    $con = getConnection();

    $user_id = mysqli_real_escape_string($con, $user_id);
    $book_id = mysqli_real_escape_string($con, $book_id);
    $qty = mysqli_real_escape_string($con, $qty);
    $check = "SELECT * FROM cart WHERE user_id='$user_id' AND book_id='$book_id'";
    $res = mysqli_query($con, $check);

    if(mysqli_num_rows($res) > 0) {
        $sql = "UPDATE cart SET quantity = quantity + $qty WHERE user_id='$user_id' AND book_id='$book_id'";
    } else {
        $sql = "INSERT INTO cart(user_id, book_id, quantity) VALUES('$user_id','$book_id','$qty')";
    }
    return mysqli_query($con, $sql);
}
function updateCart($user_id, $book_id, $qty) {
    $con = getConnection();
    $sql = "UPDATE cart SET quantity='$qty' WHERE user_id='$user_id' AND book_id='$book_id'";
    return mysqli_query($con, $sql);
}
function removeCart($user_id, $book_id) {
    $con = getConnection();
    $sql = "DELETE FROM cart WHERE user_id='$user_id' AND book_id='$book_id'";
    return mysqli_query($con, $sql);
}
?>