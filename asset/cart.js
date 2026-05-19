function validateQty(qty) {
    return Number(qty) > 0;
}

function addToCart(id) {

    let qty = document.getElementById("qty").value;
    qty = Number(qty);

    if (!validateQty(qty)) {
        alert("Invalid quantity");
        return;
    }

    let xhr = new XMLHttpRequest();
    xhr.open("POST", "api/add_to_cart.php", true);

    xhr.setRequestHeader("Content-Type", "application/json");

    xhr.withCredentials = true;

    xhr.onreadystatechange = function () {
        if (xhr.readyState === 4) {

            if (xhr.status !== 200) {
                alert("Server error");
                return;
            }

            let data;
            try {
                data = JSON.parse(xhr.responseText);
            } catch (e) {
                console.error("Invalid JSON:", xhr.responseText);
                alert("Response error from server");
                return;
            }

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