<?php
session_start();
include ("dbFunctions.php");
$id = $_SESSION['id'];
$queryL = "SELECT * FROM datal WHERE node_id = '$id'";
$queryM = "SELECT * FROM dataM WHERE node_id = '$id'";
$queryS = "SELECT * FROM dataS WHERE node_id = '$id'";


$resultL = mysqli_query($link, $queryL) or die(mysqli_error($link));
$resultM = mysqli_query($link, $queryM) or die(mysqli_error($link));
$resultS = mysqli_query($link, $queryS) or die(mysqli_error($link));
?>
<html>
    <head>
        <script>
            function OnSubmitForm()
            {
                if (document.pressed == 'Edit')
                {
                    document.myform.action = "editData.php";
                }
                else if (document.pressed == 'Delete')
                {
                    document.myform.action = "doDeleteData.php";
                } else {
                    document.myform.action = "compareData.php";
                }
                return true;
            }
        </script> 
        <title>View Data</title>
        <link rel="stylesheet" href="style/style.css" type="text/css" />
    </head>
    <body>
        <?php include ('navi.php'); ?>
        <form method="post" name="myform" onsubmit="return OnSubmitForm();">
            <table>
                <tr>
                    <th><h2>DATAL</h2></th>
                <th>
                    <input type="submit" value="Edit" onclick="document.pressed = this.value">
                </th>
                <th>
                    <input type="submit" value="Delete" onclick="document.pressed = this.value">
                </th>
                <th>
                    <input type="submit" value="Compare" onclick="document.pressed = this.value">
                </th>

                </tr>

                <tr>
                    <th>Node ID</th>
                    <th>Time Stamp</th>
                    <th>Humidity</th>
                    <th>Ambient Temperature</th>
                    <th>IR Temperature</th>
                    <th>Pressure</th>
                    <th>Air Quality</th>
                    <th>Latitude</th>
                    <th>Longitude</th>
                    <th>Selected</th>
                </tr>
                <?php
                while ($rowL = mysqli_fetch_array($resultL)) {
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
                        <td><?php echo $node_id; ?></td>
                        <td><?php echo $time_stamp; ?></td>
                        <td><?php echo $humidity; ?></td>
                        <td><?php echo $ambient_temp; ?></td>
                        <td><?php echo $ir_temp; ?></td>
                        <td><?php echo $pressure; ?></td>
                        <td><?php echo $air_quality; ?></td>
                        <td><?php echo $latitude; ?></td>
                        <td><?php echo $longitude; ?></td>
                        <td>


                            <input type="checkbox" name="selectedRows[]" value="<?php echo $l_id ?>">
                        </td>
                    </tr> 
                <?php } ?>
            </table>
        </form>

        <table>
            <tr>
                <th><h2>DATAM</h2></th>
    </tr>
    <tr>
        <th>Node ID</th>
        <th>Time Stamp</th>
        <th>Light</th>
        <th>Meters</th>
        <th>Functions</th>
    </tr>
    <?php
    while ($rowM = mysqli_fetch_array($resultM)) {
        $ID = $rowM['M_id'];
        $nodeId = $rowM['node_id'];
        $timeStamp = $rowM['time_stamp'];
        $light = $rowM['light'];
        $meter = $rowM['meter'];
        ?>
        <tr>
            <td><?php echo $nodeId; ?></td>
            <td><?php echo $timeStamp; ?></td>
            <td><?php echo $light; ?></td>
            <td><?php echo $meter; ?></td>
            <td>
                <form method="post" action="editData.php">
                    <input type="hidden" name="data_id" value="<?php echo $ID ?>">
                    <input type="submit" value="EDIT">
                </form>
                <form method="post" action="doDeleteData.php">
                    <input type="hidden" name="data_id" value="<?php echo $ID ?>">
                    <input type="submit" value="DELETE">
                </form>
                <form method="post" action="compareData.php">
                    <input type="hidden" name="data_id" value="<?php echo $ID ?>">
                    <input type="submit" value="COMPARE">
                </form>
            </td>
        </tr> 
    <?php } ?>
</table>
<table>
    <tr>
        <th><h2>DATAS</h2></th>
</tr>
<tr>
    <th>Node ID</th>
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
    $ID = $rowS['S_id'];
    $nodeId = $rowS['node_id'];
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
        <td><?php echo $nodeId; ?></td>
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
        <td>
            <form method="post" action="editData.php">
                <input type="hidden" name="data_id" value="<?php echo $ID ?>">
                <input type="submit" value="EDIT">
            </form>
            <form method="post" action="doDeleteData.php">
                <input type="hidden" name="data_id" value="<?php echo $ID ?>">
                <input type="submit" value="DELETE">
            </form>
            <form method="post" action="compareData.php">
                <input type="hidden" name="data_id" value="<?php echo $ID ?>">
                <input type="submit" value="COMPARE">
            </form>
        </td>
    </tr> 
<?php } ?>
</table>
</body>
</html>

