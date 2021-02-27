<?php
session_start();
include ("dbFunctions.php");

$msg = "";
$idList = $_POST['data_id'];
$timeStampList = $_POST['time_stamp'];
$humidityList = $_POST['humidity'];
$ambientTempList = $_POST['ambient_temp'];
$irTempList = $_POST['IR_temp'];
$pressureList = $_POST['pressure'];
$airQualityList = $_POST['air_quality'];
$latitudeList = $_POST['latitude'];
$longitudeList = $_POST['longitude'];
$arrLen = count($idList);
for ($i = 0; $i < $arrLen; $i++) {
    $queryChk = "SELECT time_stamp, humidity, ambient_temp, IR_temp, pressure, air_quality,latitude,longitude FROM datal WHERE L_id ='$idList[$i]'";
    $resultChk = mysqli_query($link, $queryChk) or die(mysqli_error($link));
//have to fecth to $rowChk before updating
    $rowChk = mysqli_fetch_assoc($resultChk);
//build a query to update the table
//update the record with the details from the form
    $queryUpdate = "UPDATE datal SET time_stamp = '$timeStampList[$i]', humidity = '$humidityList[$i]',
ambient_temp = '$ambientTempList[$i]', IR_temp = '$irTempList[$i]', pressure = '$pressureList[$i]', air_quality = '$airQualityList[$i]', latitude = '$latitudeList[$i]',longitude = '$longitudeList[$i]'
WHERE L_id ='$idList[$i]'";

//execute the query
    $resultUpdate = mysqli_query($link, $queryUpdate) or die(mysqli_error($link));
}



//if statement to check whether the update is successful
//store the success or error message into variable $msg
if ($resultUpdate) {
    $msg = "record successfully updated";
} else {
    $msg = "record updated unsucessful";
}
?>
<!DOCTYPE html>
<html>
    <head>
        <link href="stylesheets/style.css" rel="stylesheet" type="text/css"/>
        <meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
        <title>Edit Data</title>
    </head>
    <body>
        <?php include ('navi.php'); ?>
        <h1>FYP - Edit Data</h1><br>
        <h2><?php echo $msg; ?></h2>
    </body>
</html>
