<?php

session_start();

require_once('../models/OrderModel.php');

if (!isset($_SESSION['user_id'])) {
    header('location: ../public/index.php');
    exit();
}

if ($_SESSION['role'] != 'customer') {
    echo "Access denied! Customer only.";
    exit();
}

$user_id = $_SESSION['user_id'];

$action = "";

if (isset($_GET['action'])) {
    $action = $_GET['action'];
}

if ($action == "confirmation") {

    if (!isset($_GET['order_id'])) {
        echo "Order ID missing!";
        exit();
    }

    $order_id = $_GET['order_id'];

    $order = getOrderById($order_id, $user_id);

    if (!$order) {
        echo "Order not found!";
        exit();
    }

    $orderItems = getOrderItems($order_id);

    require_once('../views/order_confirmation.php');

} else if ($action == "history") {

    $orders = getPurchaseHistory($user_id);

    require_once('../views/purchase_history.php');

} else {
    header('location: OrderController.php?action=history');
    exit();
}

?>