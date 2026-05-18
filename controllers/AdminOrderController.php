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

    // Bug fix: cast to integer to ensure clean input
    $order_id = intval($_POST['order_id']);
    $status = $_POST['status'];

    $allowedStatus = ["pending", "confirmed", "shipped", "delivered"];

    if ($order_id <= 0 || $status == "") {
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

$rawOrders = getAllOrders();

// Bug fix: build nested orders+items structure in the controller so the view receives ready-to-render data and never calls model functions
$orders = [];
foreach ($rawOrders as $order) {
    $order['items'] = getAdminOrderItems($order['id']);
    $orders[] = $order;
}

require_once('../views/admin_orders.php');

?>