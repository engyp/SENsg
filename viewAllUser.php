<?php
session_start();
include 'dbFunctions.php';
include './navi.php';
$queryUser = ("SELECT * FROM users u, roles r WHERE u.roles_id=r.roles_id");
$userResult = mysqli_query($link, $queryUser) or die(mysqli_error($link));

$queryRole = ("SELECT * FROM roles WHERE roles_id != 4 AND roles_id != 5");
$roleResult = mysqli_query($link, $queryRole) or die(mysqli_error($link));

$roleResultScript = mysqli_query($link, $queryRole) or die(mysqli_error($link));
?>
<!DOCTYPE html>
<html>
    <head>
        <script>
            function OnSubmitForm()
            {
<?php while ($roleR = mysqli_fetch_array($roleResultScript)) { ?>
                    if (document.pressed === '<?php echo $roleR['role_name']; ?>')
                    {
                        document.myform.roleType.value = "<?php echo $roleR['roles_id']; ?>";
                        document.myform.action = "doChangeRole.php";
                    }
<?php } ?>
                if (document.pressed === 'Delete')
                {
                    document.myform.action = "doDeleteUser.php";
                }
                return true;
            }
        </script>
        <meta charset="UTF-8">
        <title></title>
    </head>
    <body>
        <form method="post" name="myform" onsubmit="return OnSubmitForm();">
            <table border="1">
                <tr>
                    <td colspan="1">Change Role to : </td>
                    <td colspan="3">
                        <?php while ($roleRow = mysqli_fetch_array($roleResult)) { ?>
                            <input type="submit" value="<?php echo $roleRow['role_name']; ?>" onclick="document.pressed = this.value"/>
                        <?php } ?>
                        <input type="submit" value="Delete" onclick="document.pressed = this.value">
                        <input type="hidden" name="roleType" value="0">
                    </td>
                </tr>
                <tr>
                    <th>Name</th>
                    <th>NRIC</th>
                    <th>Current Role</th>
                    <th>check</th>
                </tr>

                <?php
                while ($row = mysqli_fetch_array($userResult)) {
                    ?>
                    <tr>
                        <td><?php echo $row['name']; ?></td>
                        <td><?php echo $row['node_id']; ?></td>
                        <td><?php echo $row['role_name']; ?></td>
                        <td>
                            <?php if ($row['roles_id'] != 4) { ?>
                                <input type="checkbox" name="selectedRows[]" value="<?php echo $row['node_id']; ?>">
                            <?php } ?>
                        </td>
                    </tr>
                <?php } ?>
            </table>
        </form>
    </body>
</html>
