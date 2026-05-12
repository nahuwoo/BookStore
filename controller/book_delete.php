<?php
    require_once('../model/book_model.php');
    $id = $_REQUEST['id'];
    $result = deleteBook($id);

    if($result){
        echo "success";
        header('location: ../view/admin_book_management.php?action=edit_del');
    }
    else{
        echo "error";
    }
?>