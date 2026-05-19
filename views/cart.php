<?php
session_start();
require_once('../config/db.php');
require_once('../models/Cart.php');

if(!isset($_SESSION['user_id'])){
    die('Please Login');
}

$con = getConnection();
$items = getCartItems($_SESSION['user_id']);
$total = 0;

?>

<html>
<head>
    <title>Cart</title>
</head>
<body>
<h1>My Cart</h1>

<table border="1" cellpadding="10">
<tr>
    <th>Book</th>
    <th>Price</th>
    <th>Quantity</th>
    <th>Subtotal</th>
    <th>Action</th>
</tr>

<?php foreach($items as $item): ?>

<?php
$subtotal = $item['price'] * $item['quantity'];
$total += $subtotal;
?>
<tr>
    <td><?php echo htmlspecialchars($item['title']); ?></td>
    <td><?php echo $item['price']; ?></td>
    <td>
        <input type="number"
               min="1"
               value="<?php echo $item['quantity']; ?>"
               onchange="updateCart(<?php echo $item['book_id']; ?>, this.value)">
    </td>
    <td><?php echo $subtotal; ?> TK</td>
    <td>
        <button onclick="removeItem(<?php echo $item['book_id']; ?>)">
            Remove
        </button>
    </td>
</tr>
<?php endforeach; ?>
</table>

<h2>Total: <?php echo $total; ?> TK</h2>

<script>
function updateCart(bookId, quantity) {

    var xhr = new XMLHttpRequest();
    xhr.open("POST", "../api/update_cart.php", true);
    xhr.setRequestHeader("Content-Type", "application/json");

    xhr.onreadystatechange = function () {
        if (xhr.readyState === 4 && xhr.status === 200) {

            var data = JSON.parse(xhr.responseText);
            alert(data.message);
            location.reload();
        }
    };
    var data = JSON.stringify({
        book_id: bookId,
        quantity: quantity
    });

    xhr.send(data);
}

function removeItem(bookId) {
    var xhr = new XMLHttpRequest();
    xhr.open("POST", "../api/remove_cart.php", true);
    xhr.setRequestHeader("Content-Type", "application/json");

    xhr.onreadystatechange = function () {
        if (xhr.readyState === 4 && xhr.status === 200) {

            var data = JSON.parse(xhr.responseText);

            alert(data.message);
            location.reload();
        }
    };
    var data = JSON.stringify({
        book_id: bookId
    });

    xhr.send(data);
}
</script>
</body>
</html>