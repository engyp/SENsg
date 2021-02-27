<?php

include 'dbFunctions.php';

$name = $_POST['name'];
$name = mysqli_real_escape_string($link, $name);

$nric = $_POST['nric'];
$nric = mysqli_real_escape_string($link, $nric);

$email = htmlspecialchars($_POST['email']);
$email = mysqli_real_escape_string($link, $email);

$password = htmlspecialchars($_POST['password']);
$password = mysqli_real_escape_string($link, $password);

$school = $_POST['school'];

$select = "SELECT * FROM users WHERE node_id = '$nric' OR email = '$email'";
$selectQuery = mysqli_query($link, $select) or die(mysqli_error($link));

if (mysqli_num_rows($selectQuery)) {
    $message = "User name is already used";
    header("refresh:3;url=register.php");
} else {
    $insertQuery = "INSERT INTO users (name, node_id, school_id, email, password, roles_id)
    VALUES ('$name', '$nric', '$school', '$email', SHA1('$password'), '5')";

    $status = mysqli_query($link, $insertQuery) or die(mysqli_error($link));

    if ($status) {
        $message = "Book Record Successfully Added!";
    } else {
        $message = "Book Record Failed to add!";
    }
}

echo $status;
echo $message;
echo $name;
echo $nric;
echo $email;
echo $password;
?>