<?php

session_start();
require_once('../models/Book.php');

if(!isset($_GET['id'])){
    die('Invalid Book');
}
$id = $_GET['id'];
$book = getBook($id);
if(!$book){
    die('Book Not Found');
}


/* 
AJAX Add to Cart add later

*/

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
</body>
</html>