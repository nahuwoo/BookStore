<?php

require_once('../models/Book.php');

function getBooksController() {
    return getAllBooks();
}

function searchBooksController($q, $filter) {
    return searchBooks($q, $filter);
}

function getBookController($id) {
    return getBook($id);
}
?>