<?php
    require_once('db.php');

function getAllBooks() {
    $con = getConnection();
    $sql = "SELECT b.*, c.name AS category_name  FROM books b JOIN categories c ON b.category_id = c.id ORDER BY b.id DESC";
    $result = mysqli_query($con, $sql);
    $books = [];
    while ($row = mysqli_fetch_assoc($result)) {
        $books[] = $row;
    }
    return $books;
}

function createBook($title, $author, $desc, $price, $cat_id, $stock, $image_path) {
    $con = getConnection();
    $sql = "INSERT INTO books (title, author, description, price, category_id, image_path, stock) 
            VALUES ('$title', '$author', '$desc', '$price', '$cat_id', '$image_path', '$stock')";
    return mysqli_query($con, $sql); 
}

function updateBook($id, $title, $author, $desc, $price, $cat_id, $stock, $image_path) {
    $con = getConnection();
    if ($image_path == null) {
        $sql = "UPDATE books SET title='$title', author='$author', description='$desc', 
                price='$price', category_id='$cat_id', stock='$stock' WHERE id='$id'";
    } else {
        $sql = "UPDATE books SET title='$title', author='$author', description='$desc', 
                price='$price', category_id='$cat_id', stock='$stock', image_path='$image_path' WHERE id='$id'";
    }
    return mysqli_query($con, $sql);
}

function deleteBook($id) {
    $con = getConnection();
    $sql = "DELETE FROM books WHERE id = '$id'";
    return mysqli_query($con, $sql); 
}

?>
