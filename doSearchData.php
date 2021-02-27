<?php
session_start();
include ("dbFunctions.php");

$search_id = $_POST['data_id'];

// built sql query
$query = "SELECT * 
         FROM datal
         WHERE L_id = '$search_id'";


// execute sql query
$result = mysqli_query($link, $query) or die('Error querying database');

// check if $result is empty
if (mysqli_num_rows($result) == 0) {
    echo "<h2>No matching record found</h2>";
    header("Refresh:3;url=searchData.php");
}

//close connection
mysqli_close($link);
?>
<html>
    <head>
        <title>Search</title>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <link href="stylesheets/style.css" rel="stylesheet" type="text/css"/>
    </head>
    <body>
        <?php include ('navi.php'); ?>
        <table>
            <tr>
                <th>ID</th>
                <th>Time Stamp</th>		
                <th>Humidity</th>
                <th>Ambient Temperature</th>
                <th>IR Temperature</th>
                <th>Pressure</th>
                <th>Air Quality</th>
                <th>Latitude</th>
                <th>Longitude</th>
            </tr>
            <?php
// process the result - fetch from it into $row
            while ($row = mysqli_fetch_array($result)) {
                ?>
                <tr>
                    <td><?php echo $row['L_id']; ?></td>
                    <td><?php echo $row['time_stamp']; ?></td>
                    <td><?php echo $row['humidity']; ?></td>
                    <td><?php echo $row['ambient_temp']; ?></td>
                    <td><?php echo $row['IR_temp']; ?></td>
                    <td><?php echo $row['pressure']; ?></td>
                    <td><?php echo $row['air_quality']; ?></td>
                    <td><?php echo $row['latitude']; ?></td>
                    <td><?php echo $row['longitude']; ?></td>
                </tr>
            <?php } ?>
        </table>
    </body>
</html>

