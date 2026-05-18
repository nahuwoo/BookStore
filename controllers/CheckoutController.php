<?php

session_start();

require_once('../models/OrderModel.php');

if (!isset($_SESSION['user_id'])) {
    if (isset($_POST['ajax_checkout'])) {
        header('Content-Type: application/json');
        echo json_encode(["success" => false, "message" => "Please login first."]);
        exit();
    }

    header('location: ../public/index.php');
    exit();
}

if ($_SESSION['role'] != 'customer') {
    if (isset($_POST['ajax_checkout'])) {
        header('Content-Type: application/json');
        echo json_encode(["success" => false, "message" => "Access denied! Customer only."]);
        exit();
    }

    echo "Access denied! Customer only.";
    exit();
}

$user_id = $_SESSION['user_id'];
$error = "";
$cartItems = getCartItems($user_id);
$total = calculateCartTotal($cartItems);

// Bug fix: generate CSRF token if not already set
if (empty($_SESSION['csrf_token'])) {
    $_SESSION['csrf_token'] = bin2hex(random_bytes(32));
}

if (isset($_POST['ajax_checkout'])) {

    header('Content-Type: application/json');

    // Verify CSRF token
    if (!isset($_POST['csrf_token']) || $_POST['csrf_token'] !== $_SESSION['csrf_token']) {
        echo json_encode(["success" => false, "message" => "Invalid request. Please try again."]);
        exit();
    }

    $address = trim($_POST['address']);
    $payment_method = "";

    if (isset($_POST['payment_method'])) {
        $payment_method = $_POST['payment_method'];
    }

    if (count($cartItems) == 0) {
        echo json_encode(["success" => false, "message" => "Your cart is empty!"]);
        exit();
    }

    if ($address == "") {
        echo json_encode(["success" => false, "message" => "Address is required!"]);
        exit();
    }

    if ($payment_method == "") {
        echo json_encode(["success" => false, "message" => "Please select a payment method!"]);
        exit();
    }

    $allowedMethods = ["Credit Card", "bKash", "Nagad", "Bank Transfer", "Cash on Delivery"];

    if (!in_array($payment_method, $allowedMethods)) {
        echo json_encode(["success" => false, "message" => "Invalid payment method!"]);
        exit();
    }

    $order_id = createOrder($user_id, $total, $payment_method);

    if ($order_id == false) {
        echo json_encode(["success" => false, "message" => "Order could not be created!"]);
        exit();
    }

    $allItemsInserted = true;

    foreach ($cartItems as $item) {
        $insertStatus = createOrderItem(
            $order_id,
            $item['book_id'],
            $item['quantity'],
            $item['price']
        );

        if (!$insertStatus) {
            $allItemsInserted = false;
        } else {
            // Reduce stock for each successfully inserted item
            reduceStock($item['book_id'], $item['quantity']);
        }
    }

    if (!$allItemsInserted) {
        echo json_encode(["success" => false, "message" => "Order items could not be saved!"]);
        exit();
    }

    $transaction_id = "TXN" . time();

    $paymentStatus = createPayment(
        $order_id,
        $total,
        $payment_method,
        $transaction_id
    );

    if (!$paymentStatus) {
        echo json_encode(["success" => false, "message" => "Payment information could not be saved!"]);
        exit();
    }

    // Regenerate CSRF token after successful use
    $_SESSION['csrf_token'] = bin2hex(random_bytes(32));
    clearCart($user_id);

    echo json_encode([
        "success" => true,
        "message" => "Order placed successfully!",
        "redirect" => "OrderController.php?action=confirmation&order_id=" . $order_id
    ]);
    exit();
}

// Pass CSRF token to view via a variable (view never generates its own logic)
$csrf_token = $_SESSION['csrf_token'];

require_once('../views/checkout.php');

?>