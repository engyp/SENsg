<?php
include 'dbFunctions.php';

if (isset($_POST['selectedRows'])) {
    $allID = $_POST['selectedRows'];
    $role = $_POST['roleType'];
    print_r($allID);

    foreach ($allID as $id) {
        $updateQuery = "UPDATE users SET roles_id = '$role' WHERE `node_id` = '$id'";
        $updateResult = mysqli_query($link, $updateQuery);
    }
    echo "Cange(s) have been made.";
} else {
    echo "There is no selection";
}

header("refresh:3;url=viewAllUser.php");
?>
