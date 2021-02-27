<?php
session_start();
include ("dbFunctions.php");
$header = $_POST['selectedCol'];
$allCmpID = $_POST['selectedRows'];
$query = "SELECT `$header` FROM datal WHERE L_id = '$allCmpID[0]'";
$result = mysqli_query($link, $query) or die(mysqli_error($link));
$row = mysqli_fetch_array($result);
$min = $row[0];
foreach ($allCmpID as $id) {
    $query = "SELECT `$header` FROM datal WHERE L_id = '$id'";
    $result = mysqli_query($link, $query) or die(mysqli_error($link));
    $row = mysqli_fetch_array($result);
    if ($row[0] < $min) {
        $min= $row[0];
    }
}
echo $min;