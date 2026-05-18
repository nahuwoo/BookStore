<?php
    require_once('../config/db.php');

    function getAllOrders() {
    $con = getConnection();
    $sql = "SELECT u.name, b.title , o.total_amount, o.status, o.payment_method, o.order_date FROM orders o JOIN users u ON o.user_id = u.id JOIN order_items oi ON o.id = oi.order_id JOIN books b ON oi.book_id = b.id GROUP BY o.id ORDER BY o.order_date DESC;";
    $result = mysqli_query($con, $sql);
    $orders = [];
    while ($row = mysqli_fetch_assoc($result)) {
        $orders[] = $row;
    }
    return $orders;
}
    function getTotalOrders(){
        $con=getConnection();
        $sql="SELECT COUNT(*) AS total_orders FROM orders";
        $result=mysqli_query($con,$sql);
        $row=mysqli_fetch_assoc($result);
        return $row['total_orders'];
    }
    function getTotalRevenue(){
        $con=getConnection();
        $sql="SELECT IFNULL(SUM(total_amount),0) AS total_revenue FROM orders";
        $result=mysqli_query($con,$sql);
        $row=mysqli_fetch_assoc($result);
        return $row['total_revenue'];
    }
    function getBookOrderCount($book_id){
        $con = getConnection();
        $sql = "SELECT COUNT(*) AS total FROM orders WHERE id=? AND status='pending'";
        $stmt = mysqli_prepare($con, $sql);
        mysqli_stmt_bind_param($stmt, "i", $book_id);
        mysqli_stmt_execute($stmt);
        $result = mysqli_stmt_get_result($stmt);
        $row = mysqli_fetch_assoc($result);
        return $row['total'];
    }
?>