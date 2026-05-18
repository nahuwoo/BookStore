<!DOCTYPE html>
<html>
<head>
    <title>Admin Order Processing</title>
    <link rel="stylesheet" href="../public/style.css">
</head>
<body>

<div class="container">

    <h2>Admin Order Processing</h2>

    <p>
        <a href="../public/index.php">Home</a>
    </p>

    <p id="message"></p>

    <?php if (count($orders) == 0) { ?>

        <div class="card">
            <p>No orders found.</p>
        </div>

    <?php } else { ?>

        <?php foreach ($orders as $order) { ?>

            <?php $items = getAdminOrderItems($order['id']); ?>

            <div class="card">

                <h3>Order #<?php echo htmlspecialchars($order['id']); ?></h3>

                <p><b>Customer:</b> <?php echo htmlspecialchars($order['name']); ?></p>
                <p><b>Email:</b> <?php echo htmlspecialchars($order['email']); ?></p>
                <p><b>Total:</b> <?php echo htmlspecialchars($order['total_amount']); ?></p>
                <p><b>Payment:</b> <?php echo htmlspecialchars($order['payment_method']); ?></p>
                <p><b>Date:</b> <?php echo htmlspecialchars($order['order_date']); ?></p>

                <table>
                    <tr>
                        <th>Book</th>
                        <th>Quantity</th>
                        <th>Unit Price</th>
                    </tr>

                    <?php foreach ($items as $item) { ?>
                        <tr>
                            <td><?php echo htmlspecialchars($item['title']); ?></td>
                            <td><?php echo htmlspecialchars($item['quantity']); ?></td>
                            <td><?php echo htmlspecialchars($item['unit_price']); ?></td>
                        </tr>
                    <?php } ?>
                </table>

                <br>

                <label>Status</label>

                <select id="status_<?php echo htmlspecialchars($order['id']); ?>">
                    <option value="pending" <?php if ($order['status'] == "pending") echo "selected"; ?>>pending</option>
                    <option value="confirmed" <?php if ($order['status'] == "confirmed") echo "selected"; ?>>confirmed</option>
                    <option value="shipped" <?php if ($order['status'] == "shipped") echo "selected"; ?>>shipped</option>
                    <option value="delivered" <?php if ($order['status'] == "delivered") echo "selected"; ?>>delivered</option>
                </select>

                <button class="btn" onclick="updateStatus(<?php echo htmlspecialchars($order['id']); ?>)">
                    Update Status
                </button>

            </div>

        <?php } ?>

    <?php } ?>

</div>

<script src="../public/admin_orders.js"></script>

</body>
</html>