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
    Total Books: <?= $total_books?>
    Total Customers: <?= $total_customers?>
    Total Orders: <?= $total_orders?>
    Total Revenue: <?= $total_revenue?><br>
    <a href='../controller/logout.php'>Logout</a><br><br>
    <a href='admin_book_management.php'>Book Management</a><br><br>
    <a href='admin_view_users.php'>View Users</a><br><br>
    <a href='admin_customer_removal.php'>Remove Customers</a><br><br>
    <a href='admin_view_orders.php'>View Orders</a><br><br>
</body>
</html>