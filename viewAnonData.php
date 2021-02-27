<?php
include ("dbFunctions.php");

$queryL = "SELECT * FROM datal";
$queryM = "SELECT * FROM dataM";
$queryS = "SELECT * FROM dataS";


$resultL = mysqli_query($link, $queryL) or die(mysqli_error($link));
$resultM = mysqli_query($link, $queryM) or die(mysqli_error($link));
$resultS = mysqli_query($link, $queryS) or die(mysqli_error($link));
?>
<html>
    <head>
        <title>View Data</title>
        <link rel="stylesheet" href="style/style.css" type="text/css" />
    </head>
    <body>
        <?php
        include("header.php");
        ?>
        <table>
            <tr>
                <th><h2>DATAL</h2></th>
        <th>
        <form method="post" action="downloadAnonData.php">
            <input type="submit" value="Download DATAL">
        </form>
    </th>

</tr>
<tr>
    <th style="border: 2px solid black">Time Stamp</th>
    <th style="border: 2px solid black">Humidity</th>
    <th style="border: 2px solid black">Ambient Temperature</th>
    <th style="border: 2px solid black">IR Temperature</th>
    <th style="border: 2px solid black">Pressure</th>
    <th style="border: 2px solid black">Air Quality</th>
    <th style="border: 2px solid black">Latitude</th>
    <th style="border: 2px solid black">Longitude</th>
</tr>
<?php
while ($rowL = mysqli_fetch_array($resultL)) {
    $time_stamp = $rowL['time_stamp'];
    $humidity = $rowL['humidity'];
    $ambient_temp = $rowL['ambient_temp'];
    $ir_temp = $rowL['IR_temp'];
    $pressure = $rowL['pressure'];
    $air_quality = $rowL['air_quality'];
    $latitude = $rowL['latitude'];
    $longitude = $rowL['longitude'];
    ?>
    <tr>
        <td><?php echo $time_stamp; ?></td>
        <td><?php echo $humidity; ?></td>
        <td><?php echo $ambient_temp; ?></td>
        <td><?php echo $ir_temp; ?></td>
        <td><?php echo $pressure; ?></td>
        <td><?php echo $air_quality; ?></td>
        <td><?php echo $latitude; ?></td>
        <td><?php echo $longitude; ?></td>
    </tr>
<?php } ?>
</table>

<form method="post" action="downloadAnonData.php">
    <input type="hidden" name="data_id" value="<?php echo $l_id ?>">
    <input type="submit" value="Download DATAM">
</form>
<table>
    <tr>
        <th><h2>DATAM</h2></th>
</tr>
<tr>
    <th>Time Stamp</th>
    <th>Light</th>
    <th>Meters</th>
    <th>Functions</th>
</tr>
<?php
while ($rowM = mysqli_fetch_array($resultM)) {
    $timeStamp = $rowM['time_stamp'];
    $light = $rowM['light'];
    $meter = $rowM['meter'];
    ?>
    <tr>
        <td><?php echo $timeStamp; ?></td>
        <td><?php echo $light; ?></td>
        <td><?php echo $meter; ?></td>
    </tr> 
<?php } ?>
</table>

<form method="post" action="downloadAnonData.php">
    <input type="hidden" name="data_id" value="<?php echo $l_id ?>">
    <input type="submit" value="Download DATAS">
</form>
<table>
    <tr>
        <th><h2>DATAS</h2></th>
</tr>
<tr>
    <th>Time Stamp</th>
    <th>Current</th>
    <th>Voltage</th>
    <th>Noise</th>
    <th>Acceleration X</th>
    <th>Acceleration Y</th>
    <th>Acceleration Z</th>
    <th>Rotation X</th>
    <th>Rotation Y</th>
    <th>Rotation Z</th>
</tr>
<?php
while ($rowS = mysqli_fetch_array($resultS)) {
    $timeStamp = $rowS['time_stamp'];
    $current = $rowS['current'];
    $voltage = $rowS['voltage'];
    $noise = $rowS['noise'];
    $accX = $rowS['accel_X'];
    $accY = $rowS['accel_Y'];
    $accZ = $rowS['accel_Z'];
    $rotX = $rowS['rot_X'];
    $rotY = $rowS['rot_Y'];
    $rotZ = $rowS['rot_Z'];
    ?>
    <tr>
        <td><?php echo $timeStamp; ?></td>
        <td><?php echo $current; ?></td>
        <td><?php echo $voltage; ?></td>
        <td><?php echo $noise; ?></td>
        <td><?php echo $accX; ?></td>
        <td><?php echo $accY; ?></td>
        <td><?php echo $accZ; ?></td>
        <td><?php echo $rotX; ?></td>
        <td><?php echo $rotY; ?></td>
        <td><?php echo $rotZ; ?></td>
    </tr> 
<?php } ?>
</table>
</body>
</html>
