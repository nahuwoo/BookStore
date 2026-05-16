<?php       
    require_once('../model/book_model.php');
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
    <title>Edit Form</title>
    <link rel="stylesheet" href="../asset/css/style.css">

</head>
<body>
    <form action="../controller/book_add_edit_check.php" method="post" enctype="multipart/form-data" id='edit_form' >
        <h2 style="text-align:center;">Add/Update Book</h2>  
        Book ID: <input type="text" name="id" readonly value="<?= htmlspecialchars($book['id'], ENT_QUOTES, 'UTF-8') ?>"><br><br>
        Title: <input type="text" name="title" value="<?= htmlspecialchars($book['title'], ENT_QUOTES, 'UTF-8') ?>"><br><br>
        Author: <input type="text" name="author" value="<?= htmlspecialchars($book['author'], ENT_QUOTES, 'UTF-8') ?>"><br><br>
        Description: <br>
        <textarea name="description"><?= htmlspecialchars($book['description'], ENT_QUOTES, 'UTF-8') ?></textarea>
        Price: <input type="number" name="price" value="<?= htmlspecialchars($book['price'], ENT_QUOTES, 'UTF-8') ?>"><br><br>
        Category: <select name="category" >
                    <option value="1"  <?=($book['category_name'] == 'Poetry') ? 'selected' : ''?> >Poetry</option>
                    <option value="2" <?=($book['category_name'] == 'Novel') ? 'selected' : ''?> >Novel</option>
                    <option value="3" <?=($book['category_name'] == 'Drama') ? 'selected' : ''?> >Drama</option>
                    <option value="4" <?=($book['category_name'] == 'History') ? 'selected' : ''?>>History</option>
                    <option value="5" <?=($book['category_name'] == 'Science') ? 'selected' : ''?> >Science</option>
                </select><br><br>
        Stock Quantity: <input type="number" name="stock" value="<?= htmlspecialchars($book['stock'], ENT_QUOTES, 'UTF-8') ?>"><br><br>
        <input type="submit" name="submit" value="Edit Book">
    </form>
</body>
</html>