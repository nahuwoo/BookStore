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

?>