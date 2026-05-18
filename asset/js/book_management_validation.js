function validateBookForm() {
    alert("JS running");
    let title = document.getElementById('title').value.trim();
    let author = document.getElementById('author').value.trim();
    let description = document.getElementById('description').value.trim();
    let price = document.getElementById('price').value;
    let category = document.getElementById('category').value;
    let stock = document.getElementById('stock').value;
    let image = document.getElementById('book_image').value;
    let error = document.getElementById('error');
    error.textContent = "";

    if(title === ""){
        error.textContent = "Title is required";
        return false;
    }
    if(author === ""){
        error.textContent = "Author is required";
        return false;
    }
    if(description === ""){
        error.textContent = "Description is required";
        return false;
    }
    if(price === ""){
        error.textContent = "Price is required";
        return false;
    }
    if(Number(price) <= 0){
        error.textContent = "Price must be a valid number";
        return false;
    }
    if(category === ""){
        error.textContent = "Category is required";
        return false;
    }
    if(stock === ""){
        error.textContent = "Stock is required";
        return false;
    }
    if(Number(stock) < 0){
        error.textContent = "Stock must be a valid number";
        return false;
    }
    if(image !== ""){
        let extension = image.split('.').pop().toLowerCase();
        if(
            extension !== "jpg" &&
            extension !== "jpeg" &&
            extension !== "png"
        ){
            error.textContent = "Only JPG, JPEG and PNG files are allowed";
            return false;
        }
    }
    return true;
}