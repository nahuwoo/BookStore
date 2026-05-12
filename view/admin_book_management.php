<html>
    <head>
        <title>View Users</title>
        <link rel="stylesheet" href="../asset/css/style.css">
    </head>
    <body>
        <form action="" method="post" enctype="multipart/form-data">
        <h2 style="text-align:center;">Add/Update Book</h2>    
        Title: <input type="text" name="title" ><br><br>
        Author: <input type="text" name="author" ><br><br>
        Description: <br>
        <textarea name="description" ></textarea><br><br>
        Price: <input type="number" name="price" step="0.01" min="0.01" ><br><br>

        Category: <select name="category" >
                    <option value="">Select Category</option>
                    <option value="Fiction">Fiction</option>
                    <option value="Science">Science</option>
                    <option value="History">History</option>
                    <option value="Technology">Technology</option>
                </select><br><br>
        Stock Quantity: <input type="number" name="stock" min="0"><br><br>
        Book Image (format: jpeg, png):<input type="file" name="image" accept=".jpg,.jpeg,.png" ><br><br>


        <input type="submit" name="submit" value="Add Book">
</form>
    </body>
</html>