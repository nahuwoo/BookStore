<?php
    require_once('db.php');

    function getAllBooks(){
        $con = getConnection();
        $sql = "SELECT b.*, c.name AS category_name FROM books b JOIN categories c ON b.category_id = c.id ORDER BY b.id";
        $result = mysqli_query($con,$sql);
        $books=[];
        while($row=mysqli_fetch_assoc($result)){$books[]=$row;}
        return $books;
    }

    function createBook($title,$author,$description,$price,$category_id,$stock,$image_path){
        $con=getConnection();
        $sql="INSERT INTO books(title,author,description,price,category_id,image_path,stock) VALUES(?,?,?,?,?,?,?)";
        $stmt=mysqli_prepare($con,$sql);
        mysqli_stmt_bind_param($stmt,"sssdisi",$title,$author,$description,$price,$category_id,$image_path,$stock);
        return mysqli_stmt_execute($stmt);
    }

    function updateBook($id,$title,$author,$description,$price,$category_id,$stock,$image_path){
        $con=getConnection();
        $sql="UPDATE books SET title=?,author=?,description=?,price=?,category_id=?,stock=?,image_path=? WHERE id=?";
        $stmt=mysqli_prepare($con,$sql);
        mysqli_stmt_bind_param($stmt,"sssdiisi",$title,$author,$description,$price,$category_id,$stock,$image_path,$id);
        return mysqli_stmt_execute($stmt);
        }

    function deleteBook($id){
        $con=getConnection();
        $sql="DELETE FROM books WHERE id=?";
        $stmt=mysqli_prepare($con,$sql);
        mysqli_stmt_bind_param($stmt,"i",$id);
        return mysqli_stmt_execute($stmt);
    }
?>