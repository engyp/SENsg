<?php

session_start();
include ("dbFunctions.php");
$header = $_POST['selectedCol'];
$allCmpID = $_POST['selectedRows'];
$total = 0.0;
foreach ($allCmpID as $id) {
    $query = "SELECT `$header` FROM datal WHERE L_id = '$id'";
    $result = mysqli_query($link, $query) or die(mysqli_error($link));
    $row = mysqli_fetch_array($result);
    $total += $row[0];
}
echo $total / count($allCmpID);
