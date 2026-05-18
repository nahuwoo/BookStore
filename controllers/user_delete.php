<?php
    require_once('../models/user_model.php');

    $id = $_REQUEST['id'];

    $result = deleteUser($id);

    if($result){
        echo "success";
    }
    else{
        echo "error";
    }
?>
