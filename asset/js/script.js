
function validateBookForm() {

    let error = document.getElementById("error");

    let title = document.getElementById("title").value.trim();
    let author = document.getElementById("author").value.trim();
    let description = document.getElementById("description").value.trim();
    let price = document.getElementById("price").value;
    let category = document.getElementById("category").value;
    let stock = document.getElementById("stock").value;
    let image = document.getElementById("image").value;

    error.style.display = "block";
    error.style.color = "white";
    error.style.background = "red";
    error.style.padding = "10px";
    error.style.marginBottom = "10px";

    if(title === ""){
        error.innerHTML = "Title is required";
        return false;
    }

    if(author === ""){
        error.innerHTML = "Author is required";
        return false;
    }

    if(description.length < 10){
        error.innerHTML = "Description must be at least 10 characters";
        return false;
    }

    if(price === "" || parseFloat(price) <= 0){
        error.innerHTML = "Enter a valid price";
        return false;
    }

    if(category === ""){
        error.innerHTML = "Please select a category";
        return false;
    }

    if(stock === "" || parseInt(stock) < 0){
        error.innerHTML = "Enter valid stock quantity";
        return false;
    }

    if(image === ""){
        error.innerHTML = "Please upload a book image";
        return false;
    }

    let allowedExtensions = /(\.jpg|\.jpeg|\.png)$/i;
    if(!allowedExtensions.exec(image)){
        error.innerHTML = "Only jpg, jpeg, png allowed";
        return false;
    }

    error.innerHTML = "";
    error.style.display = "none";

    return true;
}
