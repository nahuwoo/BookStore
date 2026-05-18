function deleteCustomer(id) {
    if(confirm("Are you sure you want to delete this customer?")){
        let xhr = new XMLHttpRequest();
        xhr.open("GET", "../controllers/user_delete.php?id=" + id);
        xhr.onload = function() {
            if(xhr.responseText === "success"){
                document.getElementById("customer_row_" + id).remove();
            } else {
                alert("Delete failed");
            }
        };
        xhr.send();
    }
}
