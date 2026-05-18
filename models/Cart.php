<?php
require_once('../config/db.php');

function getCartItems($user_id) {
    $con = getConnection();
    $sql = "SELECT cart.*, books.title, books.price  FROM cart JOIN books ON cart.book_id = books.id WHERE cart.user_id = ?";
    $stmt = mysqli_prepare($con, $sql);
    mysqli_stmt_bind_param($stmt, "i", $user_id);
    mysqli_stmt_execute($stmt);
    $result = mysqli_stmt_get_result($stmt);
    $items = [];
    while ($row = mysqli_fetch_assoc($result)) {
        $items[] = $row;
    }
    return $items;
}

function addToCart($user_id, $book_id, $qty) {
    $con = getConnection();
    $sql = "SELECT quantity FROM cart WHERE user_id = ? AND book_id = ?";
    $stmt = mysqli_prepare($con, $sql);
    mysqli_stmt_bind_param($stmt, "ii", $user_id, $book_id);
    mysqli_stmt_execute($stmt);
    $result = mysqli_stmt_get_result($stmt);
    $existing = mysqli_fetch_assoc($result);

    if ($existing) {
        $newQty = $existing['quantity'] + $qty;
        $sql = "UPDATE cart SET quantity = ? WHERE user_id = ? AND book_id = ?";
        $stmt = mysqli_prepare($con, $sql);
        mysqli_stmt_bind_param($stmt, "iii", $newQty, $user_id, $book_id);

    } else {
        $sql = "INSERT INTO cart (user_id, book_id, quantity) VALUES (?, ?, ?)";
        $stmt = mysqli_prepare($con, $sql);
        mysqli_stmt_bind_param($stmt, "iii", $user_id, $book_id, $qty);
    }

    return mysqli_stmt_execute($stmt);
}

function updateCart($user_id, $book_id, $qty) {
    $con = getConnection();
    $sql = "UPDATE cart SET quantity = ? WHERE user_id = ? AND book_id = ?";
    $stmt = mysqli_prepare($con, $sql);
    mysqli_stmt_bind_param($stmt, "iii", $qty, $user_id, $book_id);

    return mysqli_stmt_execute($stmt);
}

function removeCart($user_id, $book_id) {
    $con = getConnection();
    $sql = "DELETE FROM cart WHERE user_id = ? AND book_id = ?";
    $stmt = mysqli_prepare($con, $sql);
    mysqli_stmt_bind_param($stmt, "ii", $user_id, $book_id);
    return mysqli_stmt_execute($stmt);
}
?>