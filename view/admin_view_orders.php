<?php
    require_once('../model/order_model.php');
    $orders = getAllOrders();
?>
<html>
<head>
    <title>View Orders</title>
    <link rel="stylesheet" href="../asset/css/style.css">
</head>
<body>
    <!-- <input type ='button' action='admin_dashboard.php' value='back'> -->
    <h2>View Orders</h2>

    <table border="1">

        <tr>
            <th>Name</th>
            <th>Title</th>
            <th>Total Amount</th>
            <th>Status</th>
            <th>Payment Method</th>
            <th>Order Date</th>
        </tr>

        <?php
            foreach($orders as $order){
        ?>

        <tr>
            <td><?php echo $order['name']; ?></td>
            <td><?php echo $order['title']; ?></td>
            <td><?php echo $order['total_amount']; ?></td>
            <td><?php echo $order['status']; ?></td>
            <td><?php echo $order['payment_method']; ?></td>
            <td><?php echo $order['order_date']; ?></td>
        </tr>

        <?php
            }
        ?>

    </table>
</body>
</html>