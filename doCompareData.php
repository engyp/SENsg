<?php
include ("dbFunctions.php");
$query = "SELECT time_stamp, humidity, ambient_temp, IR_temp, pressure, air_quality, latitude,longitude
         FROM datal d,compare c
         WHERE d.L_id=c.L_id";
$result = mysqli_query($link, $query) or die(mysqli_error($link));
?>
<!DOCTYPE html>
<html>
    <head>
        <title>Compare Data</title>
    </head>
    <body>       
        <h1>FYP - Compare Data</h1><br>
        <table>
            <tr>
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
            <tr>
                <td><input type="submit" value="diff"></td>
                <td>
                    <form method="post" action="minHumidity.php"><input type="submit" value="min"></form>
                    <form method="post" action="maxHumidity.php"><input type="submit" value="max"></form>
                    <form method="post" action="avgHumidity.php"><input type="submit" value="avg"></form>
                </td>
                <td><input type="submit" value="min"><input type="submit" value="max"><input type="submit" value="diff"></td>
                <td><input type="submit" value="min"><input type="submit" value="max"><input type="submit" value="diff"></td>
                <td><input type="submit" value="min"><input type="submit" value="max"><input type="submit" value="diff"></td>
                <td><input type="submit" value="min"><input type="submit" value="max"><input type="submit" value="diff"></td>
                <td><input type="submit" value="null"></td>
            </tr>
        </table>
        <form method="post" action="clearData.php">
            <input type="submit" value="CLEAR Data">
        </form>
    </body>
</html>