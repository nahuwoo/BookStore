<!DOCTYPE html>
<html>
<head>
    <title>Checkout</title>
    <link rel="stylesheet" href="../public/style.css">
</head>
<body>

<div class="container">

    <h2>Checkout</h2>

    <p>
        <a href="../public/index.php">Home</a> |
        <a href="../controllers/OrderController.php?action=history">Purchase History</a>
    </p>

    <?php if ($error != "") { ?>
        <p class="error"><?php echo htmlspecialchars($error); ?></p>
    <?php } ?>

    <?php if (count($cartItems) == 0) { ?>

        <div class="card">
            <p>Your cart is empty. Please add books before checkout.</p>
        </div>

    <?php } else { ?>

        <div class="card">
            <h3>Order Summary</h3>

            <table>
                <tr>
                    <th>Book</th>
                    <th>Quantity</th>
                    <th>Unit Price</th>
                    <th>Subtotal</th>
                </tr>

                <?php foreach ($cartItems as $item) { ?>
                    <tr>
                        <td><?php echo htmlspecialchars($item['title']); ?></td>
                        <td><?php echo htmlspecialchars($item['quantity']); ?></td>
                        <td><?php echo htmlspecialchars($item['price']); ?></td>
                        <td><?php echo htmlspecialchars($item['price'] * $item['quantity']); ?></td>
                    </tr>
                <?php } ?>

                <tr>
                    <th colspan="3">Total</th>
                    <th><?php echo htmlspecialchars($total); ?></th>
                </tr>
            </table>
        </div>

        <div class="card">
            <h3>Confirm Checkout</h3>

            <form method="POST" action="../controllers/CheckoutController.php" onsubmit="return validateCheckout()">

                <label>Confirm Address</label>
                <textarea name="address" id="address" rows="4" placeholder="Enter delivery address"></textarea>
                <p id="addressError" class="error"></p>

                <label>Payment Method</label>
                <select name="payment_method" id="payment_method">
                    <option value="">Select Payment Method</option>
                    <option value="Credit Card">Credit Card</option>
                    <option value="bKash">bKash</option>
                    <option value="Nagad">Nagad</option>
                    <option value="Bank Transfer">Bank Transfer</option>
                    <option value="Cash on Delivery">Cash on Delivery</option>
                </select>
                <p id="paymentError" class="error"></p>

                <input type="submit" name="place_order" value="Place Order" class="btn">

            </form>
        </div>

    <?php } ?>

</div>

<script src="../public/checkout.js"></script>

</body>
</html>