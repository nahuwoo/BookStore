<?php
    require_once('db.php');
    function getAllCustomers() {
    $con = getConnection();
    $sql = "SELECT id, name, email, address, phone, created_at FROM users WHERE role = 'customer' ORDER BY id;";
    $result = mysqli_query($con, $sql);
    $orders = [];
    while ($row = mysqli_fetch_assoc($result)) {
        $orders[] = $row;
    }
    return $orders;
}
    function getTotalCustomers(){
        $con=getConnection();
        $sql="SELECT COUNT(*) AS total_customers FROM users WHERE role='customer'";
        $result=mysqli_query($con,$sql);
        $row=mysqli_fetch_assoc($result);
        return $row['total_customers'];
    }
?>