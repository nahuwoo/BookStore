<?php
    require_once('../model/user_model.php');
    $customers = getAllCustomers();
?>
<html>
<head>
    <title>Manage Customers</title>
    <link rel="stylesheet" href="../asset/css/style.css">
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

        <tr>
            <td><?php echo $customer['id']; ?></td>
            <td><?php echo $customer['name']; ?></td>
            <td><?php echo $customer['email']; ?></td>
            <td><?php echo $customer['address']; ?></td>
            <td><?php echo $customer['phone']; ?></td>
            <td><?php echo $customer['created_at']; ?></td>
            <td><a href='../controller/user_delete.php?id=<?= $customer['id']?>'>Delete</a></td>
        </tr>

        <?php
            }
        ?>

    </table>
</body>
</html>