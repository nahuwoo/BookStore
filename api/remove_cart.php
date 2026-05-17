<?php

session_start();

header('Content-Type: application/json');

require_once('../config/db.php');
require_once('../models/Cart.php');

if(!isset($_SESSION['user_id'])) {
    echo json_encode([
        'success' => false,
        'message' => 'Login required'
    ]);
    exit;
}

$data = json_decode(file_get_contents("php://input"), true);

if(!$data) {
    echo json_encode([
        'success' => false,
        'message' => 'Invalid request'
    ]);
    exit;
}

$book_id = intval($data['book_id'] ?? 0);

if($book_id <= 0) {
    echo json_encode([
        'success' => false,
        'message' => 'Invalid Book ID'
    ]);
    exit;
}

removeCart(
    $_SESSION['user_id'],
    $book_id
);

echo json_encode([
    'success' => true,
    'message' => 'Item Removed'
]);

?>