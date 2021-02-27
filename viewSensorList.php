<?php
include ("dbFunctions.php");

$query = "SELECT * FROM sensg";
$result = mysqli_query($link, $query) or die(mysqli_error($link));
?>
<html>
    <head>
        <title>View Sensor List</title>
        <link rel="stylesheet" href="style/style.css" type="text/css" />
    </head>
    <body>
        <?php
        include("header.php");
        ?>
        <table>
		 <th><h2>Sensor List<form method="post" action="downloadSensorList.php">
            <input type="submit" value="Download Sensor List">
         </form></h2></th>
    <tr>
        <th style="border: 2px solid black">Serial Number</th>
        <th style="border: 2px solid black">Model</th>
        <th style="border: 2px solid black">MAC ID</th>
        <th style="border: 2px solid black">Version</th>
    </tr>
    <?php
    while ($row = mysqli_fetch_array($result)) {
        $serial_number = $row['serial_number'];
        $model = $row['model'];
        $mac_id = $row['MAC_id'];
        $version = $row['version'];
        ?>
        <tr>
            <td><?php echo $serial_number; ?></td>
            <td><?php echo $model; ?></td>
            <td><?php echo $mac_id; ?></td>
            <td><?php echo $version; ?></td>
        </tr>
    <?php } ?>
</table>