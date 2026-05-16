<?php
    require_once('../model/user_model.php');
    $users = getAllUsers();
?>
<html>
<head>
    <title>View Users</title>
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