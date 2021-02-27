<?php
include ("dbFunctions.php");

$node_id = $_POST['node_id'];

$queryStudentName = "SELECT * from users where node_id = $node_id";
$resultStudentName = mysqli_query($link, $queryStudentName) or die("Error: " . $queryStudentName);

$queryViewL = "SELECT * FROM datal where node_id =$node_id";
$resultViewL = mysqli_query($link, $queryViewL) or die("Error: " . $queryViewL);

$rowStudentName = mysqli_fetch_array($resultStudentName);
?>
<html>
    <head>
        <meta charset="UTF-8">
        <title>View Student Info</title>
    </head>
    <body>
        <table style="border: 1px solid black">
            <tr>
                <th><h2><?php echo $rowStudentName['name']?>'s DATAL</h2></th>
    </tr>
    <tr>
        <th style="border: 2px solid black">Node ID</th>
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
    while ($rowL = mysqli_fetch_array($resultViewL)) {
        $l_id = $rowL['L_id'];
        $node_id = $rowL['node_id'];
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
            <td style="border: 2px solid black"><?php echo $node_id; ?></td>
            <td style="border: 2px solid black"><?php echo $time_stamp; ?></td>
            <td style="border: 2px solid black"><?php echo $humidity; ?></td>
            <td style="border: 2px solid black"><?php echo $ambient_temp; ?></td>
            <td style="border: 2px solid black"><?php echo $ir_temp; ?></td>
            <td style="border: 2px solid black"><?php echo $pressure; ?></td>
            <td style="border: 2px solid black"><?php echo $air_quality; ?></td>
            <td style="border: 2px solid black"><?php echo $latitude; ?></td>
            <td style="border: 2px solid black"><?php echo $longitude; ?></td>
        </tr> 
    <?php } ?>
</table>
</body>
</html>
