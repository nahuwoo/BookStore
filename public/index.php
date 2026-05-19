<?php

session_start();

/*
    TEMPORARY INDEX FILE FOR VIEW TESTING
    Purpose:
    - Run all Task 4 views without database
    - Do not edit anything inside /views
    - Later replace this index.php with the real homepage/router
*/

// fake login session
$_SESSION['user_id'] = 2;
$_SESSION['name'] = 'Demo Customer';
$_SESSION['role'] = 'customer';


// -----------------------------
// Dummy functions used by views
// -----------------------------

function getOrderItems($order_id)
{
    return [
        [
            'title' => 'Introduction to PHP',
            'quantity' => 2,
            'unit_price' => 500
        ],
        [
            'title' => 'Web Technologies Basics',
            'quantity' => 1,
            'unit_price' => 650
        ]
    ];
}

function getAdminOrderItems($order_id)
{
    return getOrderItems($order_id);
}


// -----------------------------
// Dummy data for checkout view
// -----------------------------

$cartItems = [
    [
        'cart_id' => 1,
        'book_id' => 101,
        'quantity' => 2,
        'title' => 'Introduction to PHP',
        'price' => 500,
        'stock' => 10
    ],
    [
        'cart_id' => 2,
        'book_id' => 102,
        'quantity' => 1,
        'title' => 'Web Technologies Basics',
        'price' => 650,
        'stock' => 8
    ]
];

$total = 0;

foreach ($cartItems as $item) {
    $total = $total + ($item['price'] * $item['quantity']);
}

$error = "";


// -----------------------------
// Dummy data for confirmation
// -----------------------------

$order = [
    'id' => 1001,
    'user_id' => 2,
    'total_amount' => 1650,
    'status' => 'pending',
    'payment_method' => 'bKash',
    'order_date' => date('Y-m-d H:i:s')
];

$orderItems = getOrderItems(1001);


// -----------------------------
// Dummy data for purchase history
// -----------------------------

$orders = [
    [
        'id' => 1001,
        'user_id' => 2,
        'total_amount' => 1650,
        'status' => 'pending',
        'payment_method' => 'bKash',
        'order_date' => date('Y-m-d H:i:s')
    ],
    [
        'id' => 1002,
        'user_id' => 2,
        'total_amount' => 1200,
        'status' => 'delivered',
        'payment_method' => 'Cash on Delivery',
        'order_date' => date('Y-m-d H:i:s')
    ]
];


// -----------------------------
// Dummy data for admin orders
// -----------------------------

$adminOrders = [
    [
        'id' => 1001,
        'user_id' => 2,
        'name' => 'Demo Customer',
        'email' => 'customer@gmail.com',
        'total_amount' => 1650,
        'status' => 'pending',
        'payment_method' => 'bKash',
        'order_date' => date('Y-m-d H:i:s')
    ],
    [
        'id' => 1002,
        'user_id' => 3,
        'name' => 'Another Customer',
        'email' => 'customer2@gmail.com',
        'total_amount' => 1200,
        'status' => 'confirmed',
        'payment_method' => 'Cash on Delivery',
        'order_date' => date('Y-m-d H:i:s')
    ]
];


// -----------------------------
// Select which view to load
// -----------------------------

$page = "";

if (isset($_GET['page'])) {
    $page = $_GET['page'];
}

?>

<!DOCTYPE html>
<html>
<head>
    <title>Task 4 View Test</title>
    <link rel="stylesheet" href="style.css">
</head>
<body>

<div style="width:85%; margin:20px auto; background:white; padding:15px; border:1px solid #ccc;">
    <h2>Task 4 Temporary View Tester</h2>

    <a href="index.php?page=checkout">Checkout View</a> |
    <a href="index.php?page=confirmation">Order Confirmation View</a> |
    <a href="index.php?page=history">Purchase History View</a> |
    <a href="index.php?page=admin">Admin Orders View</a>
</div>

<?php

if ($page == "checkout") {

    require_once('../views/checkout.php');

} else if ($page == "confirmation") {

    require_once('../views/order_confirmation.php');

} else if ($page == "history") {

    require_once('../views/purchase_history.php');

} else if ($page == "admin") {

    $_SESSION['role'] = 'admin';
    $orders = $adminOrders;

    require_once('../views/admin_orders.php');

} else {
    echo "<div style='width:85%; margin:20px auto; background:white; padding:15px; border:1px solid #ccc;'>";
    echo "<p>Select a view from above.</p>";
    echo "</div>";
}

?>

</body>
</html>