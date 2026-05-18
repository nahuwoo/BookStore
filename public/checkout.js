function validateCheckout() {
    let address = document.getElementById('address').value;
    let payment_method = document.getElementById('payment_method').value;

    let addressError = document.getElementById('addressError');
    let paymentError = document.getElementById('paymentError');

    addressError.innerHTML = "";
    paymentError.innerHTML = "";

    let valid = true;

    if (address == "") {
        addressError.innerHTML = "Address is required!";
        valid = false;
    }

    if (payment_method == "") {
        paymentError.innerHTML = "Please select a payment method!";
        valid = false;
    }

    return valid;
}

function placeOrder() {

    let address = document.getElementById('address').value;
    let payment_method = document.getElementById('payment_method').value;
    let csrf_token = document.getElementById('csrf_token').value;

    let xhttp = new XMLHttpRequest();

    xhttp.open('POST', '../controllers/CheckoutController.php', true);

    xhttp.setRequestHeader("Content-type", "application/x-www-form-urlencoded");

    xhttp.send(
        'ajax_checkout=1' +
        '&address=' + encodeURIComponent(address) +
        '&payment_method=' + encodeURIComponent(payment_method) +
        '&csrf_token=' + encodeURIComponent(csrf_token)
    );

    xhttp.onreadystatechange = function() {

        if (this.readyState == 4 && this.status == 200) {

            let response = JSON.parse(this.responseText);
            
            let message = document.getElementById('checkoutMessage');
            message.innerHTML = "Placing your order...";
            message.className = "";
            if (response.success) {
                message.innerHTML = response.message;
                message.className = "success";

                setTimeout(function() {
                    window.location.href = response.redirect;
                }, 1000);

            } else {
                message.innerHTML = response.message;
                message.className = "error";
            }
        }
    }
}