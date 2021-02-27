<?php

include ("dbFunctions.php");

$output = "";
$sql = "SELECT time_stamp, humidity, ambient_temp, IR_temp, pressure, air_quality, latitude, longitude FROM datal";
$resultL = mysqli_query($link, $sql) or die(mysqli_error($link));
$columns_total = mysqli_num_fields($resultL);

for ($i = 0; $i < $columns_total; $i++) {
    $heading =mysqli_fetch_field_direct($resultL, $i)->name;
    $output .= '"' . $heading . '",';
}
$output .="\n";

while ($row = mysqli_fetch_array($resultL)) {
    for ($i = 0; $i < $columns_total; $i++) {
        $output .='"' . $row["$i"] . '",';
    }
    $output .="\n";
}

$filename = "DATAL.csv";
header('Content-type: application/csv');
header('Content-Disposition: attachment; filename=' . $filename);

echo $output;
exit;
?>