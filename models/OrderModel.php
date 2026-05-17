<?php

require_once('../config/db.php');

function getCartItems($user_id)
{
    $conn = getConnection();

    $sql = "SELECT cart.id AS cart_id, cart.book_id, cart.quantity,
                   books.title, books.price, books.stock
            FROM cart
            INNER JOIN books ON cart.book_id = books.id
            WHERE cart.user_id = ?";

    $stmt = mysqli_prepare($conn, $sql);
    mysqli_stmt_bind_param($stmt, "i", $user_id);
    mysqli_stmt_execute($stmt);

    $result = mysqli_stmt_get_result($stmt);

    $cartItems = [];

    while ($row = mysqli_fetch_assoc($result)) {
        $cartItems[] = $row;
    }

    return $cartItems;
}

function calculateCartTotal($cartItems)
{
    $total = 0;

    foreach ($cartItems as $item) {
        $total = $total + ($item['price'] * $item['quantity']);
    }

    return $total;
}

function createOrder($user_id, $total_amount, $payment_method)
{
    $conn = getConnection();

    $status = "pending";

    $sql = "INSERT INTO orders (user_id, total_amount, status, payment_method, order_date)
            VALUES (?, ?, ?, ?, NOW())";

    $stmt = mysqli_prepare($conn, $sql);
    mysqli_stmt_bind_param($stmt, "idss", $user_id, $total_amount, $status, $payment_method);

    if (mysqli_stmt_execute($stmt)) {
        return mysqli_insert_id($conn);
    } else {
        return false;
    }
}

function createOrderItem($order_id, $book_id, $quantity, $unit_price)
{
    $conn = getConnection();

    $sql = "INSERT INTO order_items (order_id, book_id, quantity, unit_price)
            VALUES (?, ?, ?, ?)";

    $stmt = mysqli_prepare($conn, $sql);
    mysqli_stmt_bind_param($stmt, "iiid", $order_id, $book_id, $quantity, $unit_price);

    return mysqli_stmt_execute($stmt);
}

function createPayment($order_id, $amount, $payment_method, $transaction_id)
{
    $conn = getConnection();

    $sql = "INSERT INTO payments (order_id, amount, payment_method, transaction_id, payment_date)
            VALUES (?, ?, ?, ?, NOW())";

    $stmt = mysqli_prepare($conn, $sql);
    mysqli_stmt_bind_param($stmt, "idss", $order_id, $amount, $payment_method, $transaction_id);

    return mysqli_stmt_execute($stmt);
}

function clearCart($user_id)
{
    $conn = getConnection();

    $sql = "DELETE FROM cart WHERE user_id = ?";

    $stmt = mysqli_prepare($conn, $sql);
    mysqli_stmt_bind_param($stmt, "i", $user_id);

    return mysqli_stmt_execute($stmt);
}

function getOrderById($order_id, $user_id)
{
    $conn = getConnection();

    $sql = "SELECT * FROM orders WHERE id = ? AND user_id = ?";

    $stmt = mysqli_prepare($conn, $sql);
    mysqli_stmt_bind_param($stmt, "ii", $order_id, $user_id);
    mysqli_stmt_execute($stmt);

    $result = mysqli_stmt_get_result($stmt);

    return mysqli_fetch_assoc($result);
}

function getOrderItems($order_id)
{
    $conn = getConnection();

    $sql = "SELECT order_items.quantity, order_items.unit_price,
                   books.title
            FROM order_items
            INNER JOIN books ON order_items.book_id = books.id
            WHERE order_items.order_id = ?";

    $stmt = mysqli_prepare($conn, $sql);
    mysqli_stmt_bind_param($stmt, "i", $order_id);
    mysqli_stmt_execute($stmt);

    $result = mysqli_stmt_get_result($stmt);

    $items = [];

    while ($row = mysqli_fetch_assoc($result)) {
        $items[] = $row;
    }

    return $items;
}

function getPurchaseHistory($user_id)
{
    $conn = getConnection();

    $sql = "SELECT * FROM orders
            WHERE user_id = ?
            ORDER BY order_date DESC";

    $stmt = mysqli_prepare($conn, $sql);
    mysqli_stmt_bind_param($stmt, "i", $user_id);
    mysqli_stmt_execute($stmt);

    $result = mysqli_stmt_get_result($stmt);

    $orders = [];

    while ($row = mysqli_fetch_assoc($result)) {
        $orders[] = $row;
    }

    return $orders;
}

function getAllOrders()
{
    $conn = getConnection();

    $sql = "SELECT orders.*, users.name, users.email
            FROM orders
            INNER JOIN users ON orders.user_id = users.id
            ORDER BY orders.order_date DESC";

    $stmt = mysqli_prepare($conn, $sql);
    mysqli_stmt_execute($stmt);

    $result = mysqli_stmt_get_result($stmt);

    $orders = [];

    while ($row = mysqli_fetch_assoc($result)) {
        $orders[] = $row;
    }

    return $orders;
}

function getAdminOrderItems($order_id)
{
    return getOrderItems($order_id);
}

function updateOrderStatus($order_id, $status)
{
    $conn = getConnection();

    $sql = "UPDATE orders SET status = ? WHERE id = ?";

    $stmt = mysqli_prepare($conn, $sql);
    mysqli_stmt_bind_param($stmt, "si", $status, $order_id);

    return mysqli_stmt_execute($stmt);
}

?>