function searchBooks() {
    let q = document.getElementById("searchInput").value;
    let filter = document.getElementById("filter").value;

    let xhr = new XMLHttpRequest();
    xhr.open("GET", "../api/search_books.php?q=" + q + "&filter=" + filter, true);
    xhr.onreadystatechange = function () {
        if (xhr.readyState == 4 && xhr.status == 200) {
            let response = JSON.parse(xhr.responseText);
            let container = document.getElementById("bookContainer");

            container.innerHTML = "";
            if (response.success == false) {
                container.innerHTML = "<p style='color:red;'>" + response.message + "</p>";
                return;
            }
            let books = response.data;
            if (books.length == 0) {
                container.innerHTML = "<p>No books found</p>";
                return;
            }
            for (let i = 0; i < books.length; i++) {
                let b = books[i];
                container.innerHTML += "<div class='book'>" + "<h3>" + b.title + "</h3>" +
                        "<p>Author: " + b.author + "</p>" +
                        "<p>Category: " + b.category_name + "</p>" +
                        "<p>Price: " + b.price + " TK</p>" +
                        "<a href='book_details.php?id=" + b.id + "'>View Details</a>" +
                    "</div>";
            }
        }
    };

    xhr.send();
}