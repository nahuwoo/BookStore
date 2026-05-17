<?php
session_start();

header('Content-Type: application/json');

require_once('../config/db.php');
require_once('../models/Cart.php');

if(!isset($_SESSION['user_id'])) {
    echo json_encode([
        'success'=>false,
        'message'=>'Login required'
    ]);
    exit;
}

$data = json_decode(file_get_contents("php://input"), true);

if(!$data) {
    echo json_encode([
        'success'=>false,
        'message'=>'Invalid request'
    ]);
    exit;
}

$user_id = $_SESSION['user_id'];

$book_id = intval($data['book_id'] ?? 0);
$qty = intval($data['quantity'] ?? 0);

if($book_id <= 0 || $qty <= 0) {
    echo json_encode([
        'success'=>false,
        'message'=>'Invalid data'
    ]);
    exit;
}

$con = getConnection();

$sql = "SELECT stock FROM books WHERE id=$book_id";

$res = mysqli_query($con, $sql);

if(!$res) {
    echo json_encode([
        'success'=>false,
        'message'=>'Database error'
    ]);
    exit;
}

$book = mysqli_fetch_assoc($res);

if(!$book) {
    echo json_encode([
        'success'=>false,
        'message'=>'Book not found'
    ]);
    exit;
}

if($qty > $book['stock']) {
    echo json_encode([
        'success'=>false,
        'message'=>'Not enough stock'
    ]);
    exit;
}

updateCart($user_id, $book_id, $qty);

$count = mysqli_fetch_assoc(mysqli_query(
    $con,
    "SELECT SUM(quantity) as total FROM cart WHERE user_id='$user_id'"
));

echo json_encode([
    'success'=>true,
    'message'=>'Cart updated',
    'cart_count'=>$count['total'] ?? 0
]);
?>