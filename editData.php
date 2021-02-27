<?php
session_start();
include ("dbFunctions.php");
?>
<!DOCTYPE html>
<html>
    <head>
        <title>Edit Data</title>
    </head>
    <body>
        <?php include ('navi.php'); ?>
        <h1>FYP - Edit Data</h1><br>
        <form method="post" action="doEditData.php">
            <?php
            if (isset($_POST['selectedRows'])) {
                $allID = $_POST['selectedRows'];
                foreach ($allID as $id) {
                    $query = "SELECT * FROM datal WHERE L_id='$id'";
                    $result = mysqli_query($link, $query) or die(mysqli_error($link));
                    $row = mysqli_fetch_assoc($result);
                    ?>
                    <table>
                        <tr>
                            <th>Time Stamp:</th>
                            <td><textarea rows="1" cols="30" name="time_stamp[]"><?php echo $row['time_stamp']; ?></textarea></td>
                        </tr>
                        <tr>
                            <th>Humidity:</th>
                            <td><textarea rows="1" cols="30" name="humidity[]"><?php echo $row['humidity']; ?></textarea></td>
                        </tr>
                        <tr>
                            <th>Ambient Temperature:</th>
                            <td><textarea rows="1" cols="30" name="ambient_temp[]"><?php echo $row['ambient_temp']; ?></textarea></td>
                        </tr>
                        <tr>
                            <th>IR Temperature:</th>
                            <td><textarea rows="1" cols="30" name="IR_temp[]"><?php echo $row['IR_temp']; ?></textarea></td>
                        </tr>
                        <tr>
                            <th>Pressure:</th>
                            <td><textarea rows="1" cols="30" name="pressure[]"><?php echo $row['pressure']; ?></textarea></td>
                        </tr>
                        <tr>
                            <th>Air Quality:</th>
                            <td><textarea rows="1" cols="30" name="air_quality[]"><?php echo $row['air_quality']; ?></textarea></td>
                        </tr>
                        <tr>
                            <th>Latitude:</th>
                            <td><textarea rows="1" cols="30" name="latitude[]"><?php echo $row['latitude']; ?></textarea></td>
                        </tr>
                        <tr>
                            <th>Longitude:</th>
                            <td><textarea rows="1" cols="30" name="longitude[]"><?php echo $row['longitude']; ?></textarea></td>
                        </tr>
                    </table>
                    <input type="hidden" name="data_id[]" value="<?php echo $id; ?>"/>
                    <hr>


                <?php } ?>
                <input type="submit" value="Update Data"/></form>
            <?php
        } else {
            echo "there is no selection";
        }
        ?>


    </body>
</html>
