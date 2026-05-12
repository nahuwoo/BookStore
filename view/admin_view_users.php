<?php
    require_once('../model/user_model.php');
    $users = getAllUsers();
?>
<html>
<head>
    <title>View Orders</title>
    <link rel="stylesheet" href="../asset/css/style.css">
</head>
<body>
    <!-- <input type ='button' action='admin_dashboard.php' value='back'> -->
    <h2>View Users</h2>

    <table border="1">

        <tr>
            <th>Name</th>
            <th>Email</th>
            <th>Role</th>
            <th>Registration Date</th>
        </tr>

        <?php
            foreach($users as $user){
        ?>

        <tr>
            <td><?php echo $user['name']; ?></td>
            <td><?php echo $user['email']; ?></td>
            <td><?php echo $user['role']; ?></td>
            <td><?php echo $user['created_at']; ?></td>
        </tr>

        <?php
            }
        ?>

    </table>
</body>
</html>