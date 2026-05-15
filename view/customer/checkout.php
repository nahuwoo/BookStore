<?php
/*if (session_status() === PHP_SESSION_NONE) {
    session_start();
}

if (!isset($_SESSION['user_id']) || $_SESSION['role'] !== 'customer') {
    header("Location: ../login.php");
    exit();
}*/
?>

<!DOCTYPE html>
<html>
<head>
    <title>Checkout</title>
    <link rel="stylesheet" href="../../public/css/style.css">
</head>
<body>

<div class="container">
    <h2>Checkout</h2>

    <div id="message" class="error"></div>

    <form id="checkoutForm">
        <label>Confirm Delivery Address</label>
        <textarea name="address" id="address" rows="4"><?php
            echo htmlspecialchars($_SESSION['address'] ?? "");
        ?></textarea>

        <label>Payment Method</label>
        <select name="payment_method" id="payment_method">
            <option value="">-- Select Payment Method --</option>
            <option value="Credit Card">Credit Card</option>
            <option value="bKash">bKash</option>
            <option value="Nagad">Nagad</option>
            <option value="Bank Transfer">Bank Transfer</option>
            <option value="Cash on Delivery">Cash on Delivery</option>
        </select>

        <h3>Order Summary</h3>

        <table>
            <tr>
                <th>Book</th>
                <th>Price</th>
                <th>Quantity</th>
                <th>Subtotal</th>
            </tr>

            <?php while ($item = mysqli_fetch_assoc($cartItems)) { ?>
                <tr>
                    <td><?php echo htmlspecialchars($item['title']); ?></td>
                    <td><?php echo htmlspecialchars($item['price']); ?></td>
                    <td><?php echo htmlspecialchars($item['quantity']); ?></td>
                    <td><?php echo htmlspecialchars($item['price'] * $item['quantity']); ?></td>
                </tr>
            <?php } ?>
        </table>

        <h3>Total: <?php echo htmlspecialchars($total); ?> Tk</h3>

        <button type="submit">Place Order</button>
    </form>
</div>

<script src="../../public/js/checkoutValidation.js"></script>
</body>
</html>