<?php
session_start();
require_once('../models/Book.php');
$books = getAllBooks();

?>

<html>
<head>
    <title>Online Book Store</title>
    <link rel="stylesheet" href="../asset/style.css">
</head>

<body>
<h1>Online Book Store</h1>
<input type="text" id="searchInput" placeholder="Search books...">
<select id="filter">
    <option value="title">Book Name</option>
    <option value="author">Author</option>
    <option value="category">Genre</option>
</select>

<button onclick="searchBooks()">Search</button>
<hr>

<div id="bookContainer">
<?php foreach($books as $book){ ?>
    <div class="book">
        <h3><?php echo htmlspecialchars($book['title']); ?></h3>
        <p>Author: <?php echo htmlspecialchars($book['author']); ?></p>
        <p>Category: <?php echo htmlspecialchars($book['category_name']); ?></p>
        <p>Price: <?php echo $book['price']; ?> TK</p>
        <a href="book_details.php?id=<?php echo $book['id']; ?>"> View Details </a>
    </div>
<?php } ?>
</div>

<script src="../asset/search.js"></script>
</body>
</html>