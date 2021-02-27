<?php
include ("dbFunctions.php");
ini_set('max_execution_time', 0); //0 means unlimited, useful when submitting many rows of CSV data
//Upload File
//Import uploaded file to Database
$handle = fopen($_FILES['filename']['tmp_name'], "r");
$target_file = basename($_FILES["filename"]["name"]);
$fileName = $_FILES['filename']['name'];

while (($data = fgetcsv($handle, 1000, ",")) !== FALSE) {
    if (basename($_FILES['filename']['name'], ".CSV") == "DATAM" && $data[0] != "Node ID") {
        $import = "INSERT into datam(node_id, time_stamp, light, meter) values('$data[0]','$data[1]','$data[2]','$data[3]')";

        mysqli_query($link, $import) or die("Error in query: $import");
    } elseif (basename($_FILES['filename']['name'], ".CSV") == "DATAS" && $data[0] != "Node ID") {
        $import = "INSERT into datas(node_id, time_stamp, current, voltage, noise, accel_X, accel_Y, accel_Z, rot_X, rot_Y,rot_Z) VALUES('$data[0]','$data[1]','$data[2]','$data[3]','$data[4]','$data[5]','$data[6]','$data[7]','$data[8]','$data[9]','$data[10]')";

        mysqli_query($link, $import) or die("Error in query: $import");
    } elseif (basename($_FILES['filename']['name'], ".CSV") == "DATAL" && $data[0] != "Node ID") {
        array_pop($data);
        array_push($data, "\\n");
        $dataToString = implode(",", $data);
        $Locanalysis = shell_exec("python locanalysis.py " . json_encode(json_encode($dataToString)));
        //$result = shell_exec('python locanalysis.py ' . escapeshellarg(json_encode($data)));
        $latLong = json_decode($Locanalysis, true);
        $import = "INSERT into datal(node_id, time_stamp, humidity, ambient_temp, IR_temp, pressure, air_quality, latitude, longitude) VALUES('$data[0]','$data[1]','$data[2]','$data[3]','$data[4]','$data[5]','$data[6]','$latLong[0]','$latLong[1]')";
        //echo $latLong[0];
        //echo $latLong[1];
        mysqli_query($link, $import) or die("Error in query: $import");
    }
}
fclose($handle);
mysqli_close($link);
?>
<!DOCTYPE HTML>
<html>
    <head>
        <title>Upload Data</title>
    </head>
    <body>
        <?php
        if (is_uploaded_file($_FILES['filename']['tmp_name'])) {
            ?><h1>File <?php echo $target_file ?>uploaded successfully.</h1>
            <?php
        }
        ?>
    </body>
</html>