<?php
    require_once('../config/admin_gate.php');
    require_once('../models/user_model.php');
    $customers = getAllCustomers();
?>
<html>
<head>
    <title>Manage Customers</title>
    <link rel="stylesheet" href="../assets/css/style.css">
</head>
<body>
    <!-- <input type ='button' action='admin_dashboard.php' value='back'> -->
    <h2>Removal Customers</h2>

    <table border="1">

        <tr>
            <th>ID</th>
            <th>Name</th>
            <th>Email</th>
            <th>Address</th>
            <th>Phone</th>
            <th>Registration Date</th>
            <th>Action</th>
        </tr>

        <?php
            foreach($customers as $customer){
        ?>

        <tr id="customer_row_<?= $customer['id'] ?>">
            <td><?= htmlspecialchars($customer['id'], ENT_QUOTES, 'UTF-8') ?></td>
            <td><?= htmlspecialchars($customer['name'], ENT_QUOTES, 'UTF-8') ?></td>
            <td><?= htmlspecialchars($customer['email'], ENT_QUOTES, 'UTF-8') ?></td>
            <td><?= htmlspecialchars($customer['address'], ENT_QUOTES, 'UTF-8') ?></td>
            <td><?= htmlspecialchars($customer['phone'], ENT_QUOTES, 'UTF-8') ?></td>
            <td><?= htmlspecialchars($customer['created_at'], ENT_QUOTES, 'UTF-8') ?></td>
            <td><button onclick="deleteCustomer(<?= $customer['id'] ?>)">Delete</button></td>
        </tr>

        <?php
            }
        ?>

    </table>

    <script src="../assets/js/customer_delete_confirmation.js"></script>
</body>
</html>