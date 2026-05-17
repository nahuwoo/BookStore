<?php
session_start();



header('Content-Type: application/json');

require_once('../config/db.php');
require_once('../models/Cart.php');

if (!isset($_SESSION['user_id'])) {
    echo json_encode([
        'success' => false,
        'message' => 'Please login first'
    ]);
    exit;
}

$data = json_decode(file_get_contents("php://input"), true);
$book_id = isset($data['book_id']) ? (int)$data['book_id'] : 0;
$qty = isset($data['quantity']) ? (int)$data['quantity'] : 0;

if ($book_id <= 0 || $qty <= 0) {
    echo json_encode([
        'success' => false,
        'message' => 'Invalid book or quantity'
    ]);
    exit;
}

$con = getConnection();

$sql = "SELECT stock FROM books WHERE id = ?";
$stmt = mysqli_prepare($con, $sql);
mysqli_stmt_bind_param($stmt, "i", $book_id);
mysqli_stmt_execute($stmt);
$result = mysqli_stmt_get_result($stmt);
$book = mysqli_fetch_assoc($result);

if (!$book || !isset($book['stock'])) {
    echo json_encode([
        'success' => false,
        'message' => 'Book not found'
    ]);
    exit;
}

$stock = (int)$book['stock'];

$sql = "SELECT quantity FROM cart WHERE user_id = ? AND book_id = ?";
$stmt = mysqli_prepare($con, $sql);
mysqli_stmt_bind_param($stmt, "ii", $_SESSION['user_id'], $book_id);
mysqli_stmt_execute($stmt);
$result = mysqli_stmt_get_result($stmt);
$existing = mysqli_fetch_assoc($result);
$existingQty = ($existing && isset($existing['quantity'])) ? (int)$existing['quantity'] : 0;

$newQty = $existingQty + $qty;
if ($newQty > $stock) {
    echo json_encode([
        'success' => false,
        'message' => "Not enough stock. Available: $stock, Requested: $newQty"
    ]);
    exit;
}
if ($existing) {
    $sql = "UPDATE cart SET quantity = ? WHERE user_id = ? AND book_id = ?";
    $stmt = mysqli_prepare($con, $sql);
    mysqli_stmt_bind_param($stmt, "iii", $newQty, $_SESSION['user_id'], $book_id);
} else {
    $sql = "INSERT INTO cart (user_id, book_id, quantity) VALUES (?, ?, ?)";
    $stmt = mysqli_prepare($con, $sql);
    mysqli_stmt_bind_param($stmt, "iii", $_SESSION['user_id'], $book_id, $qty);
}

mysqli_stmt_execute($stmt);

$sql = "SELECT SUM(quantity) AS total FROM cart WHERE user_id = ?";
$stmt = mysqli_prepare($con, $sql);
mysqli_stmt_bind_param($stmt, "i", $_SESSION['user_id']);
mysqli_stmt_execute($stmt);
$result = mysqli_stmt_get_result($stmt);
$count = mysqli_fetch_assoc($result);

echo json_encode([
    'success' => true,
    'message' => 'Book added to cart successfully',
    'cart_count' => (int)($count['total'] ?? 0)
]);
?>