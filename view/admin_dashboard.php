<?php
    require_once('../model/book_model.php');
    require_once('../model/order_model.php');
    require_once('../model/user_model.php');

    $total_books= getTotalBooks();
    $total_customers= getTotalCustomers();
    $total_orders= getTotalOrders();
    $total_revenue= getTotalRevenue();

?>

<html>
<head>
    <title>Admin Dashboard</title>
    <link rel="stylesheet" href="../asset/css/style.css">
</head>
<body>
    Total Books: <?= htmlspecialchars($total_books, ENT_QUOTES, 'UTF-8') ?><br>
    Total Customers: <?= htmlspecialchars($total_customers, ENT_QUOTES, 'UTF-8') ?><br>
    Total Orders: <?= htmlspecialchars($total_orders, ENT_QUOTES, 'UTF-8') ?><br>
    Total Revenue: <?= htmlspecialchars($total_revenue, ENT_QUOTES, 'UTF-8') ?><br>
    <a href='../controller/logout.php'>Logout</a><br><br>
    <a href='admin_book_management.php'>Book Management</a><br><br>
    <a href='admin_view_users.php'>View Users</a><br><br>
    <a href='admin_customer_removal.php'>Remove Customers</a><br><br>
    <a href='admin_view_orders.php'>View Orders</a><br><br>
</body>
</html>