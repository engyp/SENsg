<?php

include ("dbFunctions.php");

$output = "";
$sql = "SELECT * FROM sensg";
$result = mysqli_query($link, $sql) or die(mysqli_error($link));
$columns_total = mysqli_num_fields($result);

for ($i = 0; $i < $columns_total; $i++) {
    $heading = mysqli_fetch_field_direct($result, $i)-> name;
    $output .= '"' . $heading . '",';
}
$output .="\n";

while ($row = mysqli_fetch_array($result)) {
    for ($i = 0; $i < $columns_total; $i++) {
        $output .='"' . $row["$i"] . '",';
    }
    $output .="\n";
}

$filename = "Sensor List.csv";
header('Content-type: application/csv');
header('Content-Disposition: attachment; filename=' . $filename);

echo $output;
exit;
?>