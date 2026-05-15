<?php
    require_once('db.php');

    function getAllUsers() {
        $con = getConnection();
        $sql = "SELECT name,email,role,created_at FROM users  ORDER BY id";
        $result = mysqli_query($con, $sql);
        $users = [];
        while ($row = mysqli_fetch_assoc($result)) {
            $users[] = $row;
        }
        return $users;
    }
    function deleteUser($id){
        $con=getConnection();
        $sql="DELETE FROM users WHERE id=?";
        $stmt=mysqli_prepare($con,$sql);
        mysqli_stmt_bind_param($stmt,"i",$id);
        return mysqli_stmt_execute($stmt);
    }

    function getAllCustomers() {
    $con = getConnection();
    $sql = "SELECT id, name, email, address, phone, created_at FROM users WHERE role = 'customer' ORDER BY id;";
    $result = mysqli_query($con, $sql);
    $customers = [];
    while ($row = mysqli_fetch_assoc($result)) {
        $customers[] = $row;
    }
    return $customers;
}
    function getTotalCustomers(){
        $con=getConnection();
        $sql="SELECT COUNT(*) AS total_customers FROM users WHERE role='customer'";
        $result=mysqli_query($con,$sql);
        $row=mysqli_fetch_assoc($result);
        return $row['total_customers'];
    }
?>
