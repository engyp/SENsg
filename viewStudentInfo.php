<?php
session_start();
include ("dbFunctions.php");

$queryUsers = "SELECT distinct e.experiment_name, u.node_id, u.name, r.role_name, sch.school_name, sen.serial_number, u.email 
        FROM users u, roles r, school sch, sensg sen, experiment e WHERE 
        u.roles_id = r.roles_id AND u.school_id = sch.school_id AND u.serial_number = sen.serial_number AND u.experiment_id = e.experiment_id 
        AND u.roles_id = 1 ";

$resultUsers = mysqli_query($link, $queryUsers) or die("Error: " . $queryUsers);
?>
<html>
    <head>
        <meta charset="UTF-8">
        <link href="style/style.css" rel="stylesheet" type="text/css"/>
        <title>View Student Info</title>
    </head>
    <body>
        <?php include ('navi.php'); ?>
        <table>

            <tr>
                <th>Node ID</th>
                <th>Name</th>
                <th>Role</th>
                <th>School</th>
                <th>Experiment</th>
                <th>SenSg's Serial Number</th>
                <th>Email</th>
            </tr>
            <?php
            while ($rowUsers = mysqli_fetch_array($resultUsers)) {
                ?>
                <tr>
                    <td><?php echo $rowUsers['node_id']; ?></td>
                    <td><?php echo $rowUsers['name']; ?></td>
                    <td><?php echo $rowUsers['role_name']; ?></td>
                    <td><?php echo $rowUsers['school_name']; ?></td>
                    <td><?php echo $rowUsers['experiment_name']; ?></td>
                    <td><?php echo $rowUsers['serial_number']; ?></td>
                    <td><?php echo $rowUsers['email']; ?></td>
                </tr>
            <?php } ?>
        </table>

    </body>
</html>
