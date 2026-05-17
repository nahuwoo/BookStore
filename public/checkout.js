function validateCheckout() {
    let address = document.getElementById('address').value;
    let payment_method = document.getElementById('payment_method').value;

    let addressError = document.getElementById('addressError');
    let paymentError = document.getElementById('paymentError');

    addressError.innerHTML = "";
    paymentError.innerHTML = "";

    if (address == "") {
        addressError.innerHTML = "Address is required!";
        return false;
    }

    if (payment_method == "") {
        paymentError.innerHTML = "Please select a payment method!";
        return false;
    }

    return true;
}