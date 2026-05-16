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
            <td><?= htmlspecialchars($order['name'], ENT_QUOTES, 'UTF-8') ?></td>
            <td><?= htmlspecialchars($order['title'], ENT_QUOTES, 'UTF-8') ?></td>
            <td><?= htmlspecialchars($order['total_amount'], ENT_QUOTES, 'UTF-8') ?></td>
            <td><?= htmlspecialchars($order['status'], ENT_QUOTES, 'UTF-8') ?></td>
            <td><?= htmlspecialchars($order['payment_method'], ENT_QUOTES, 'UTF-8') ?></td>
            <td><?= htmlspecialchars($order['order_date'], ENT_QUOTES, 'UTF-8') ?></td>
        </tr>

        <?php
            }
        ?>

    </table>
</body>
</html>