<?php
session_start();
include ("dbFunctions.php");

$msg = "";
$header = "";

//$username = $_POST['username'];
$username = htmlspecialchars($_POST['nric']);
$username = mysqli_real_escape_string($link, $username);

$password = htmlspecialchars($_POST['password']);
$password = mysqli_real_escape_string($link, $password);
$password = SHA1($password);

$query = "SELECT * FROM users u, roles r WHERE u.roles_id = r.roles_id AND u.nric = '$username' AND password = '$password';";
$userQuery = mysqli_query($link, $query);

if (mysqli_num_rows($userQuery) == 0) {
    $msg = "<h2>Invalid Username/Password!</h2>";
    header("refresh:3;url=login.php");
} else {
    $result = mysqli_fetch_array($userQuery);
    $_SESSION['user'] = $username;
    $_SESSION['id'] = $result['node_id'];
    $_SESSION['name'] = $result['name'];
    $_SESSION['role'] = $result['role_name'];

    $msg = "<i>Welcome " . $_SESSION['name'];
    //header("refresh:3;url=index.php");
}
mysqli_close($link);
?>

<html>
    <head>
        <title>Login</title>
    </head>
    <body>
        <?php include ('navi.php'); ?>
        <?php echo $msg; ?>
    </body>
</html>