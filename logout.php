<?php
$msg = "";
session_start();
if (isset($_SESSION['id'])) {
    session_destroy();
    $msg = "<p>You have logged out.<br /><a href='login.php'>Back</a></p>";
    header("refresh:3;url=login.php");
}
?>
<!DOCTYPE html>
<html>
    <head>
        <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
        <title>Logout</title>
    </head>
    <body>
        <?php include ('navi.php'); ?>
        <h1>Logout</h1>
        <hr />
        <?php echo $msg; ?>
        <hr>
    </body>
</html>