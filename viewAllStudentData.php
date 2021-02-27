<?php
session_start();
include ("dbFunctions.php");

$queryUsers = "SELECT node_id, name FROM users where roles_id = 1 ";
$queryL = "SELECT * FROM datal l, experiment e, users u where l.experiment_id = e.experiment_id AND l.node_id = u.node_id ";
$queryM = "SELECT * FROM dataM m, experiment e, users u where m.experiment_id = e.experiment_id AND m.node_id = u.node_id ";
$queryS = "SELECT * FROM dataS s, experiment e, users u where s.experiment_id = e.experiment_id AND s.node_id = u.node_id ";


$resultUsers = mysqli_query($link, $queryUsers) or die("Error in query: $queryUsers");
$resultL = mysqli_query($link, $queryL) or die("Error in query: $queryL");
$resultM = mysqli_query($link, $queryM) or die("Error in query: $queryM");
$resultS = mysqli_query($link, $queryS) or die("Error in query: $queryS");


mysqli_close($link);
?>
<html>
    <head>
        <meta charset="UTF-8">
        <title>View All Student Data</title>
        <script src="scripts/jquery-1.11.1.min.js"></script>
        <link href="style/style.css" rel="stylesheet" type="text/css"/>

        <script>
            $(document).ready(function () {
                $(".users").change(function () {
                    if (this.value === "0") {
                        $("tr").show();
                    }
                    else {
                        $("tr").hide();
                        $(".header").show();
                        $("." + this.value).show();
                    }
                });
            });
        </script>

    </head>
    <body>
        <?php include ('navi.php'); ?>
        <h2>View all students data</h2>

        <label>Student: </label>
        <select class="users">
            <option value ="0">All Students</option>
            <?php
            while ($fetchUsers = mysqli_fetch_array($resultUsers)) {
                echo "<option value='" . $fetchUsers['node_id'] . "'>" . $fetchUsers['name'] . "</option>";
            }
            ?>
        </select>

        <br/><br/>

        <h3>DATAL</h3>
        <hr/>
        <table>
            <tr class="header">
                <th>Node ID</th>
                <th>Student's Name</th>
                <th>Experiment</th>
                <th>Time Stamp</th>
                <th>Humidity</th>
                <th>Ambient Temperature</th>
                <th>Infrared Temperature</th>
                <th>Pressure</th>
                <th>Air Quality</th>
                <th>Latitude</th>
                <th>Longitude</th>
            </tr>
            <?php while ($fetchL = mysqli_fetch_array($resultL)) { ?>
                <tr class="<?php echo $fetchL['node_id']; ?>">
                    <td><?php echo $fetchL['node_id']; ?></td>
                    <td><?php echo $fetchL['name']; ?></td>
                    <td><?php echo $fetchL['experiment_name']; ?></td>
                    <td><?php echo $fetchL['time_stamp']; ?></td>
                    <td><?php echo $fetchL['humidity']; ?></td>
                    <td><?php echo $fetchL['ambient_temp']; ?></td>
                    <td><?php echo $fetchL['IR_temp']; ?></td>
                    <td><?php echo $fetchL['pressure']; ?></td>
                    <td><?php echo $fetchL['air_quality']; ?></td>
                    <td><?php echo $fetchL['latitude']; ?></td>
                    <td><?php echo $fetchL['longitude']; ?></td>
                </tr>

            <?php } ?>
        </table>



        <br/><br/><br/><br/>
        <h3>DATAM</h3>
        <hr/>
        <table>
            <tr class="header">
                <th>Node ID</th>
                <th>Student's Name</th>
                <th>Experiment</th>
                <th>Time Stamp</th>
                <th>Humidity</th>
                <th>Ambient Temperature</th>
            </tr>
            <?php while ($fetchM = mysqli_fetch_array($resultM)) { ?>
                <tr class="<?php echo $fetchM['node_id']; ?>">
                    <td><?php echo $fetchM['node_id']; ?></td>
                    <td><?php echo $fetchM['name']; ?></td>
                    <td><?php echo $fetchM['experiment_name']; ?></td>
                    <td><?php echo $fetchM['time_stamp']; ?></td>
                    <td><?php echo $fetchM['light']; ?></td>
                    <td><?php echo $fetchM['meter']; ?></td>
                </tr>

            <?php } ?>
        </table>



        <br/><br/><br/><br/>
        <h3>DATAS</h3>
        <hr/>
        <table>
            <tr class="header">
                <th>Node ID</th>
                <th>Student's Name</th>
                <th>Experiment</th>
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
            <?php while ($fetchS = mysqli_fetch_array($resultS)) { ?>
                <tr class="<?php echo $fetchS['node_id']; ?>">
                    <td><?php echo $fetchS['node_id']; ?></td>
                    <td><?php echo $fetchS['name']; ?></td>
                    <td><?php echo $fetchS['experiment_name']; ?></td>
                    <td><?php echo $fetchS['time_stamp']; ?></td>
                    <td><?php echo $fetchS['current']; ?></td>
                    <td><?php echo $fetchS['voltage']; ?></td>
                    <td><?php echo $fetchS['noise']; ?></td>
                    <td><?php echo $fetchS['accel_X']; ?></td>
                    <td><?php echo $fetchS['accel_Y']; ?></td>
                    <td><?php echo $fetchS['accel_Z']; ?></td>
                    <td><?php echo $fetchS['rot_X']; ?></td>
                    <td><?php echo $fetchS['rot_Y']; ?></td>
                    <td><?php echo $fetchS['rot_Z']; ?></td>
                </tr>

            <?php } ?>
        </table>
    </body>
</html>