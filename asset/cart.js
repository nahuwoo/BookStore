
function addToCart(id) {
    let qty = document.getElementById("qty").value;
    if (!validateQty(qty)) {
        alert("Invalid quantity");
        return;
    }
    let xhr = new XMLHttpRequest();
    xhr.open("POST", "api/add_to_cart.php", true);
    xhr.setRequestHeader("Content-Type", "application/json");

    xhr.onreadystatechange = function () {
        if (xhr.readyState === 4 && xhr.status === 200) {
            let data = JSON.parse(xhr.responseText);
            if (data.success) {
                document.getElementById("cartCount").innerText = data.cart_count;
            } else {
                alert(data.message);
            }
        }
    };
    xhr.send(JSON.stringify({
        book_id: id,
        quantity: qty
    }));
}