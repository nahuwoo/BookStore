<?php       
    require_once('../model/book_model');
    session_start();
    $books = getAllBooks();
    $id = $_REQUEST['id'];
    $book = [];
    foreach($books as $b){
        if($id == $b['id']){
            $book = $b;
        }
    }  
?>

<html>
<head>
    <title>Edit</title>
</head>
<body>
    <form action="../controller/book_edit.php" method="post" enctype="multipart/form-data" id='edit_form'>
        <h2 style="text-align:center;">Add/Update Book</h2>  
        Book ID: <input type="text" name="title" readonly value="<?=$book['id']?>"><br><br>
        Title: <input type="text" name="title" value="<?=$book['title']?>"><br><br>
        Author: <input type="text" name="author" value="<?=$book['author']?>"><br><br>
        Description: <br>
        <textarea name="description" value="<?=$book['description']?>"></textarea><br><br>
        Price: <input type="number" name="price" value="<?=$book['price']?>"><br><br>
        Category: <select name="category" value="<?=$book['category_name']?>" >
                    <option value="1">Poetry</option>
                    <option value="2">Novel</option>
                    <option value="3">Drama</option>
                    <option value="4">History</option>
                    <option value="5">Science</option>
                </select><br><br>
        Stock Quantity: <input type="number" name="stock" value="<?=$book['stock']?>"><br><br>
        <input type="submit" name="submit" value="Edit Book">
    </form>
</body>
</html>