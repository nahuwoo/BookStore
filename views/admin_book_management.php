<?php
    require_once('../config/admin_gate.php');
    require_once('../models/book_model.php');
    $books = getAllBooks();
    $action = "";
    if(isset($_REQUEST['action'])){
        $action = $_REQUEST['action'];
    }
?>

<html>
    <head>
        <title>Book Management</title>
        <link rel="stylesheet" href="../assets/css/style.css">
    </head>

    <body>
        <div class="topbar">
            <a href="admin_dashboard.php">Home</a>
            <a href="../controllers/logout.php">Logout</a>
        </div>

        <div class="layout">
            <div class="sidebar">
                <a href="?action=add">Add</a>
                <a href="?action=edit_del">Edit</a>
            </div>

            <div class="content">

        <?php   if($action == "add"){  ?>

            <form action="../controllers/book_add_edit_check.php" method="post" enctype="multipart/form-data" onsubmit="return validateBookForm()" >            
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
            <input type="hidden" name="form_type" value="add">
            <div id="error"></div>

            </form>

        <?php }else if($action == "edit_del"){ ?>

            <h2>views Books</h2>

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
                <td><?= htmlspecialchars($book['id'], ENT_QUOTES, 'UTF-8') ?></td>
                <td><?= htmlspecialchars($book['title'], ENT_QUOTES, 'UTF-8') ?></td>
                <td><?= htmlspecialchars($book['author'], ENT_QUOTES, 'UTF-8') ?></td>
                <td><?= htmlspecialchars($book['description'], ENT_QUOTES, 'UTF-8') ?></td>
                <td><?= htmlspecialchars($book['price'], ENT_QUOTES, 'UTF-8') ?></td>
                <td><?= htmlspecialchars($book['category_name'], ENT_QUOTES, 'UTF-8') ?></td>
                <td><?= htmlspecialchars($book['stock'], ENT_QUOTES, 'UTF-8') ?></td>
                <td>
                    <a href="book_edit_form.php?id=<?=$book['id']?>">Edit</a>
                    <a href="../controllers/book_delete.php?id=<?=$book['id']?>">Delete</a>
                </td>
            </tr>

            <?php }  ?>

        </table>
        <?php } ?>

            </div>
        </div>

        <script src='../assets/js/book_management_validation.js'></script>
    </body>
</html>