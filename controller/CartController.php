<?php
require_once('../models/Cart.php');

function addToCartController($user_id, $book_id, $quantity) {

    $user_id = (int)$user_id;
    $book_id = (int)$book_id;
    $quantity = (int)$quantity;

    if ($user_id <= 0 || $book_id <= 0 || $quantity <= 0) {
        return false;
    }
    return addToCart($user_id, $book_id, $quantity);
}

function getCartController($user_id) {
    $user_id = (int)$user_id;
    if ($user_id <= 0) 
        return [];
    return getCartItems($user_id);
}
function updateCartController($user_id, $book_id, $quantity) {

    $user_id = (int)$user_id;
    $book_id = (int)$book_id;
    $quantity = (int)$quantity;
    if ($user_id <= 0 || $book_id <= 0 || $quantity < 0) {
        return false;
    }

    return updateCart($user_id, $book_id, $quantity);
}

function removeCartController($user_id, $book_id) {
    $user_id = (int)$user_id;
    $book_id = (int)$book_id;

    if ($user_id <= 0 || $book_id <= 0) {
        return false;
    }
    return removeCart($user_id, $book_id);
}
?>