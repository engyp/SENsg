<?php
session_start();
include ("dbFunctions.php");
$allID = $_POST['selectedRows'];
$idLen = count($allID);
?>
<!DOCTYPE html>
<html>
    <head>
        <title>Compare Data</title>
        <link href="style/style.css" rel="stylesheet" type="text/css"/>
        <script src="scripts/jquery-1.11.1.min.js" type="text/javascript"></script>
        <script>
            function OnSubmitForm()
            {
                if (document.pressed == 'Average')
                {
                    document.myform.action = "average.php";
                }
                else if (document.pressed == 'Maximum')
                {
                    document.myform.action = "maximum.php";
                } else {
                    document.myform.action = "minimum.php";
                }
                return true;
            }
        </script>
<!--        <script>
            function getValue()
            {
                $.ajax({
                    type: "GET",
                    url: "maximum.php",
                    data: 
                }).done(function () {
                    $(this).addClass("done");
                });
            }
        </script>-->
    </head>
    <body>
        <?php include ('navi.php'); ?>
        <h1>FYP - Compare Data</h1><br>
        <form method="post" name="myform" onsubmit="return OnSubmitForm();">
            <table>
                <tr>
                    <th><h2>DATAL</h2></th>
                <th>
                    <input type="submit" value="Average" onclick="document.pressed = this.value">
                </th>
                <th>
                    <input type="submit" value="Maximum" onclick="document.pressed = this.value">
                </th>
                <th>
                    <input type="submit" value="Minimum" onclick="document.pressed = this.value">
                </th>
                <tr>
                <tr>
                    <th>Time Stamp<input type="radio" name="selectedCol" value="time_stamp"></th>		
                    <th>Humidity<input type="radio" name="selectedCol" value="humidity"></th>
                    <th>Ambient Temperature<input type="radio" name="selectedCol" value="ambient_temp"></th>
                    <th>IR Temperature<input type="radio" name="selectedCol" value="IR_temp"></th>
                    <th>Pressure<input type="radio" name="selectedCol" value="pressure"></th>
                    <th>Air Quality<input type="radio" name="selectedCol" value="air_quality"></th>
                    <th>Latitude<input type="radio" name="selectedCol" value="latitude"></th>
                    <th>Longitude<input type="radio" name="selectedCol" value="longitude"></th>
                </tr>
                <?php
                foreach ($allID as $id) {
                    $query = "SELECT time_stamp, humidity, ambient_temp, IR_temp, pressure, air_quality, latitude,longitude FROM datal WHERE L_id = '$id'";
                    $result = mysqli_query($link, $query);
                    $row = mysqli_fetch_array($result);
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
            </table><?php for ($i = 0; $i < $idLen; $i++) { ?>
                <input type="hidden" name="selectedRows[]" value="<?php echo $allID[$i]; ?>">
            <?php } ?>

        </form>
    </body>
</html>