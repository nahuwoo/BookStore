<?php

session_start();

require_once('../models/OrderModel.php');

if (!isset($_SESSION['user_id'])) {
    header('location: ../public/index.php');
    exit();
}

if ($_SESSION['role'] != 'admin') {
    echo "Access denied! Admin only.";
    exit();
}

if (isset($_POST['ajax_update'])) {

    header('Content-Type: application/json');

    $order_id = $_POST['order_id'];
    $status = $_POST['status'];

    $allowedStatus = ["pending", "confirmed", "shipped", "delivered"];

    if ($order_id == "" || $status == "") {
        echo json_encode(["success" => false, "message" => "Order ID and status required!"]);
        exit();
    }

    if (!in_array($status, $allowedStatus)) {
        echo json_encode(["success" => false, "message" => "Invalid order status!"]);
        exit();
    }

    $updateStatus = updateOrderStatus($order_id, $status);

    if ($updateStatus) {
        echo json_encode(["success" => true, "message" => "Order status updated!"]);
    } else {
        echo json_encode(["success" => false, "message" => "Status update failed!"]);
    }

    exit();
}

$orders = getAllOrders();

require_once('../views/admin_orders.php');

?>