<?php

require_once('../config/db.php');
function getBook($id){
    $con = getConnection();

    $sql = "SELECT b.*, c.name AS category_name FROM books b JOIN categories c ON b.category_id = c.id WHERE b.id = ?";
    $stmt = mysqli_prepare($con, $sql);
    mysqli_stmt_bind_param($stmt, "i", $id);
    mysqli_stmt_execute($stmt);
    $result = mysqli_stmt_get_result($stmt);
    return mysqli_fetch_assoc($result);
}

function getAllBooks(){
    $con = getConnection();
    $sql = "SELECT b.*, c.name AS category_name FROM books b JOIN categories c ON b.category_id = c.id ORDER BY b.id";
    $result = mysqli_query($con, $sql);

    $books = [];
    while($row = mysqli_fetch_assoc($result)){
        $books[] = $row;
    }
    return $books;
}
function searchBooks($q, $filter){

    $con = getConnection();
    $q = "%" . trim($q) . "%";

    if ($filter == "author") {
        $sql = "SELECT b.*, c.name AS category_name FROM books b JOIN categories c ON b.category_id = c.id WHERE b.author LIKE ?";
    }
    elseif ($filter == "category") {
        $sql = "SELECT b.*, c.name AS category_name FROM books b JOIN categories c ON b.category_id = c.id WHERE c.name LIKE ?";
    }
    else {
        $sql = "SELECT b.*, c.name AS category_name FROM books b JOIN categories c ON b.category_id = c.id WHERE b.title LIKE ?";
    }
    $stmt = mysqli_prepare($con, $sql);
    mysqli_stmt_bind_param($stmt, "s", $q);
    mysqli_stmt_execute($stmt);
    $result = mysqli_stmt_get_result($stmt);
    $books = [];
    while($row = mysqli_fetch_assoc($result)){
        $books[] = $row;
    }
    return $books;
}
?>