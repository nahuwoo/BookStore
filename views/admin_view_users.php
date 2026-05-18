<?php
    require_once('../config/admin_gate.php');
    require_once('../models/user_model.php');
    $users = getAllUsers();
?>
<html>
<head>
    <title>View Users</title>
    <link rel="stylesheet" href="../assets/css/style.css">
</head>
<body>
    <h2>User List</h2>

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
            <td><?= htmlspecialchars($user['name'], ENT_QUOTES, 'UTF-8') ?></td>
            <td><?= htmlspecialchars($user['email'], ENT_QUOTES, 'UTF-8') ?></td>
            <td><?= htmlspecialchars($user['role'], ENT_QUOTES, 'UTF-8') ?></td>
            <td><?= htmlspecialchars($user['created_at'], ENT_QUOTES, 'UTF-8') ?></td>
        </tr>

        <?php
            }
        ?>

    </table>
</body>
</html>