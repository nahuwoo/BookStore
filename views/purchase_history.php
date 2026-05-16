<!DOCTYPE html>
<html>
<head>
    <title>Purchase History</title>
    <link rel="stylesheet" href="../public/style.css">
</head>
<body>

<div class="container">

    <h2>My Purchase History</h2>

    <p>
        <a href="../public/index.php">Home</a> |
        <a href="../controllers/CheckoutController.php">Checkout</a>
    </p>

    <?php if (count($orders) == 0) { ?>

        <div class="card">
            <p>No purchase history found.</p>
        </div>

    <?php } else { ?>

        <?php foreach ($orders as $order) { ?>

            <?php $items = getOrderItems($order['id']); ?>

            <div class="card">

                <h3>Order #<?php echo htmlspecialchars($order['id']); ?></h3>

                <p><b>Total:</b> <?php echo htmlspecialchars($order['total_amount']); ?></p>
                <p><b>Payment Method:</b> <?php echo htmlspecialchars($order['payment_method']); ?></p>
                <p><b>Status:</b> <?php echo htmlspecialchars($order['status']); ?></p>
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

            </div>

        <?php } ?>

    <?php } ?>

</div>

</body>
</html>