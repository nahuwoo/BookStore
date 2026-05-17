<?php
header('Content-Type: application/json');
require_once('../models/Book.php');

$q = $_GET['q'];
$filter = $_GET['filter'];
if ($q == "") {
    echo json_encode([
        'success' => false,
        'message' => 'Search cannot be empty!',
        'data' => []
    ]);
    exit;
}
if ($filter != "title" && $filter != "author" && $filter != "category") {
    $filter = "title";
}
$books = searchBooks($q, $filter);
echo json_encode([
    'success' => true,
    'message' => 'Search completed',
    'data' => $books
]);

?>