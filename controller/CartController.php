<?php
require_once('../models/Cart.php');

function addToCartController($user_id, $book_id, $quantity) {
    return addToCart($user_id, $book_id, $quantity);
}
function getCartController($user_id) {
    return getCartItems($user_id);
}
function updateCartController($user_id, $book_id, $quantity) {
    return updateCart($user_id, $book_id, $quantity);
}
function removeCartController($user_id, $book_id) {
return removeCart($user_id, $book_id);}

?>