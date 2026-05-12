<?php
    require_once('../model/user_model.php');

    $id = $_REQUEST['id'];

    $result = deleteUser($id);

    if($result){
        echo "success";
        header('location: ../view/admin_customer_removal.php');
    }
    else{
        echo "error";
    }
?>