<?php

session_start();
require_once('header.php');
require_once('../models/Book.php');

if(!isset($_GET['id'])){
    die('Invalid Book');
}
$id = $_GET['id'];
$book = getBook($id);
if(!$book){
    die('Book Not Found');
}

?>

<html>
<head>
    <title>Book Details</title>
    <link rel="stylesheet" href="../asset/css/style.css">
</head>
<body>
<h2><?php echo htmlspecialchars($book['title']); ?></h2>
<p>Author: <?php echo htmlspecialchars($book['author']); ?></p>
<p>Category: <?php echo htmlspecialchars($book['category_name']); ?></p>
<p>Description: <?php echo htmlspecialchars($book['description']); ?></p>
<p>Price: <?php echo $book['price']; ?> TK</p>
<p>Stock: <?php echo $book['stock']; ?></p>
<br>

Quantity:
<input type="number" id="quantity" value="1" min="1">
<button onclick="addToCart(<?php echo $book['id']; ?>)">
    Add To Cart
</button>

<p id="message"></p>

<script>

function addToCart(bookId) {

    let quantity = document.getElementById('quantity').value;
    let message = document.getElementById('message');

    if(quantity <= 0){
        alert('Invalid Quantity');
        return;
    }

    let xhr = new XMLHttpRequest();
    xhr.open("POST", "../api/add_to_cart.php", true);
    xhr.setRequestHeader("Content-Type", "application/json");

    xhr.onreadystatechange = function () {
        if (xhr.readyState === 4 && xhr.status === 200) {
            let result = JSON.parse(xhr.responseText);
            message.innerHTML = result.message;
        }
    };

    let data = JSON.stringify({
        book_id: bookId,
        quantity: quantity
    });
    xhr.send(data);
}

</script>
</body>
</html>