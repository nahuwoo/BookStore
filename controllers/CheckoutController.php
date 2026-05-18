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
$error = "";
$cartItems = getCartItems($user_id);
$total = calculateCartTotal($cartItems);

if (isset($_POST['place_order'])) {

    $address = trim($_POST['address']);
    $payment_method = "";

    if (isset($_POST['payment_method'])) {
        $payment_method = $_POST['payment_method'];
    }

    if (count($cartItems) == 0) {
        $error = "Your cart is empty!";
    } else if ($address == "") {
        $error = "Address is required!";
    } else if ($payment_method == "") {
        $error = "Please select a payment method!";
    } else {

        $allowedMethods = ["Credit Card", "bKash", "Nagad", "Bank Transfer", "Cash on Delivery"];

        if (!in_array($payment_method, $allowedMethods)) {
            $error = "Invalid payment method!";
        } else {

            $order_id = createOrder($user_id, $total, $payment_method);

            if ($order_id == false) {
                $error = "Order could not be created!";
            } else {

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
                    }
                }

                if ($allItemsInserted) {

                    $transaction_id = "TXN" . time();

                    $paymentStatus = createPayment(
                        $order_id,
                        $total,
                        $payment_method,
                        $transaction_id
                    );

                    if ($paymentStatus) {
                        clearCart($user_id);
                        header('location: OrderController.php?action=confirmation&order_id=' . $order_id);
                        exit();
                    } else {
                        $error = "Payment information could not be saved!";
                    }

                } else {
                    $error = "Order items could not be saved!";
                }
            }
        }
    }
}

require_once('../views/checkout.php');

?>