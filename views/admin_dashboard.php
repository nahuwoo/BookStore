<?php
    require_once('../config/admin_gate.php');
    require_once('../models/book_model.php');
    require_once('../models/order_model.php');
    require_once('../models/user_model.php');

    $total_books= getTotalBooks();
    $total_customers= getTotalCustomers();
    $total_orders= getTotalOrders();
    $total_revenue= getTotalRevenue();

?>

<html>
<head>
    <title>Admin Dashboard</title>
    <link rel="stylesheet" href="../assets/css/style.css">
</head>
<body>
    <div class="topbar">
        <a href="admin_dashboard.php">Home</a>
        <a href="../controllers/logout.php">Logout</a>
    </div>

    <div class="layout">
        <div class="sidebar">
            <a href="admin_book_management.php">Book Management</a>
            <a href="admin_view_users.php">views Users</a>
            <a href="admin_customer_removal.php">Remove Customers</a>
            <a href="admin_view_orders.php">views Orders</a>
        </div>

        <div class="content">
            Total Books: <?= htmlspecialchars($total_books, ENT_QUOTES, 'UTF-8') ?><br>
            Total Customers: <?= htmlspecialchars($total_customers, ENT_QUOTES, 'UTF-8') ?><br>
            Total Orders: <?= htmlspecialchars($total_orders, ENT_QUOTES, 'UTF-8') ?><br>
            Total Revenue: <?= htmlspecialchars($total_revenue, ENT_QUOTES, 'UTF-8') ?><br>
        </div>
    </div>
</body>
</html>