<?php
    
    require_once('../models/book_model.php');
    session_start();
    
    if(!isset($_REQUEST['submit'])){
        header('location: ../views/admin_book_management.php?action=edit_del');
        exit;

    }
    $form_type = $_REQUEST['form_type']?? '';
    $title = trim($_REQUEST['title']);
    $author = trim($_REQUEST['author']);
    $description = trim($_REQUEST['description']);
    $price = $_REQUEST['price'];
    $category_id = $_REQUEST['category'];
    $stock = $_REQUEST['stock'];
    
    $errors = [];
    if($title == "")
        {$errors[] = "Title is required";}
    if($author == "")
        { $errors[] = "Author is required"; }
    if($description == "") 
        { $errors[] = "Description is required"; }
    if(!is_numeric($price) || $price <= 0)
        { $errors[] = "Price must be a valid number."; }
    if(!is_numeric($stock) || $stock < 0)
        { $errors[] = "Stock must a valid number"; }

    if(isset($_FILES['book_image'])){
    $book_image = $_FILES['book_image'];
    $book_image_name = $book_image['name'];
    $book_image_type= $book_image['type'];
    $book_image_size= $book_image['size'];
    $book_image_src= $book_image['tmp_name'];
    $book_image_dest= "../public/uploads/books/" . $book_image_name;

    if($book_image_type!='image/jpg' && $book_image_type!='image/jpeg' && $book_image_type!='image/png'){
        $errors[] = "Only JPEG and PNG allowed";
    } else {
        move_uploaded_file($book_image_src, $book_image_dest);
    }
    
    if($book_image_size> 2*1024*1024)
        $errors[] = "Picture should be less than 2 MB";
    }

    if(count($errors) > 0){
        foreach($errors as $error){
            echo $error . "<br>";
            exit;
        }
    }

    if($form_type=='edit_del'){
        $id = $_REQUEST['id'];
        updateBook($id, $title, $author, $description, $price, $category_id, $stock, $book_image_dest);
    }
    else{
        createBook($title, $author, $description, $price, $category_id, $stock, $book_image_dest);
    }

header('location: ../views/admin_book_management.php?action=edit_del');
?>