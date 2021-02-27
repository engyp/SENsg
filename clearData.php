<?php
include ("dbFunctions.php");
$query = "TRUNCATE compare";
$result = mysqli_query($link, $query) or die(mysqli_error($link));
header("Refresh:2;url=doCompareData.php");
?>
