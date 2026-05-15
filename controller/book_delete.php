<?php
    require_once('../model/book_model.php');
    require_once('../model/order_model.php');
    $id = $_REQUEST['id'];
    $book=getBook($id);

    $order_count=getBookOrderCount($id);
    if($order_count>0){
        echo "Can't delete. Book Order Pending.";
        exit;
    }

    $book_image_path=$book['image_path'];
    if(!empty($book_image_path) && file_exists($book_image_path)){
        if(unlink($book_image_path)){
        echo "Image deleted";
        } else{
        echo "Image Not Found";
        }
    }
    $result = deleteBook($id);

    if($result){
        echo "delete success";
        header('location: ../view/admin_book_management.php?action=edit_del');
    }
    else{
        echo "delete failed";
    }
?>