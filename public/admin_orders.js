function updateStatus(order_id) {
    let status = document.getElementById('status_' + order_id).value;

    let xhttp = new XMLHttpRequest();

    xhttp.open('post', '../controllers/AdminOrderController.php', true);

    xhttp.setRequestHeader("Content-type", "application/x-www-form-urlencoded");

    xhttp.send('ajax_update=1&order_id=' + order_id + '&status=' + status);

    xhttp.onreadystatechange = function() {

        if (this.readyState == 4 && this.status == 200) {

            let response = JSON.parse(this.responseText);

            let message = document.getElementById('message');

            if (response.success) {
                message.innerHTML = response.message;
                message.className = "success";
            } else {
                message.innerHTML = response.message;
                message.className = "error";
            }
        }
    }
}