<?php
    require_once('../model/book_model.php');
    $books = getAllBooks();
    $action = "";
    if(isset($_REQUEST['action'])){
        $action = $_REQUEST['action'];
    }
?>

<html>
    <head>
        <title>Book Management</title>
        <link rel="stylesheet" href="../asset/css/style.css">
    </head>

    <body>
        <a href="?action=add">Add</a>
        <a href="?action=edit_del">Edit/Delete</a>

        <?php   if($action == "add"){  ?>

            <form action="../controller/book_add_edit_check.php" method="post" enctype="multipart/form-data" onsubmit="return validateBookForm()">            
            <h2 style="text-align:center;">Add/Update Book</h2>    
            Title: <input type="text" name="title" id='title'><br><br>
            Author: <input type="text" name="author" id='author'><br><br>
            Description: <br>
            <textarea name="description" id="description" ></textarea><br><br>
            Price: <input type="number" name="price"  id='price' ><br><br>

            Category: <select name="category"  id='category'>
                        <option value="1">Poetry</option>
                        <option value="2">Novel</option>
                        <option value="3">Drama</option>
                        <option value="4">History</option>
                        <option value="5">Science</option>
                    </select><br><br>
            Stock Quantity: <input type="number" name="stock" id='stock'><br><br>
            Book Image (format: jpeg, png):<input type="file" name="book_image" id='book_image' ><br><br>

            <input type="submit" name="submit" value="Add Book">
            <div id="error"></div>

            </form>

        <?php }else if($action == "edit_del"){ ?>

            <h2>View Books</h2>

        <table border="1">
            <tr>
                <th>Book ID</th>
                <th>Title</th>
                <th>Author</th>
                <th>Description</th>
                <th>Price</th>
                <th>Category</th>
                <th>Stock</th>
                <th>Action</th>
            </tr>

            <?php
                foreach($books as $book){
            ?>

            <tr>
                <td><?php echo $book['id']; ?></td>
                <td><?php echo $book['title']; ?></td>
                <td><?php echo $book['author']; ?></td>
                <td><?php echo $book['description']; ?></td>
                <td><?php echo $book['price']; ?></td>
                <td><?php echo $book['category_name']; ?></td>
                <td><?php echo $book['stock']; ?></td>
                <td>
                    <a href="book_edit_form.php?id=<?=$book['id']?>">Edit</a>
                    <a href="../controller/book_delete.php?id=<?=$book['id']?>">Delete</a>
                </td>
            </tr>

            <?php }  ?>

        </table>
        <?php } ?>
        
        <script src='../asset/js/script.js'></script> 
    </body>
</html>