<!DOCTYPE html>
<html>
<head>
    <title>Order Confirmation</title>
    <link rel="stylesheet" href="../public/style.css">
</head>
<body>

<div class="container">

    <div class="card">
        <h2>Order Confirmed</h2>

        <p>Your order has been placed successfully.</p>

        <p><b>Order ID:</b> <?php echo htmlspecialchars($order['id']); ?></p>
        <p><b>Total Amount:</b> <?php echo htmlspecialchars($order['total_amount']); ?></p>
        <p><b>Payment Method:</b> <?php echo htmlspecialchars($order['payment_method']); ?></p>
        <p><b>Status:</b> <?php echo htmlspecialchars($order['status']); ?></p>
        <p><b>Order Date:</b> <?php echo htmlspecialchars($order['order_date']); ?></p>
    </div>

    <div class="card">
        <h3>Ordered Books</h3>

        <table>
            <tr>
                <th>Book</th>
                <th>Quantity</th>
                <th>Unit Price</th>
                <th>Subtotal</th>
            </tr>

            <?php foreach ($orderItems as $item) { ?>
                <tr>
                    <td><?php echo htmlspecialchars($item['title']); ?></td>
                    <td><?php echo htmlspecialchars($item['quantity']); ?></td>
                    <td><?php echo htmlspecialchars($item['unit_price']); ?></td>
                    <td><?php echo htmlspecialchars($item['quantity'] * $item['unit_price']); ?></td>
                </tr>
            <?php } ?>
        </table>
    </div>

    <p>
        <a href="../controllers/OrderController.php?action=history" class="btn">View Purchase History</a>
        <a href="../public/index.php" class="btn secondary">Go Home</a>
    </p>

</div>

</body>
</html>