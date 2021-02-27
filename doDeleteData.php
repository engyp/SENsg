<?php
session_start();
include ("dbFunctions.php");
$allID = $_POST['selectedRows'];
$msg = "";
foreach ($allID as $id) {
    $queryChk = "SELECT * FROM datal WHERE L_id = '$id'";
    $resultChk = mysqli_query($link, $queryChk);
    $rowChk = mysqli_fetch_array($resultChk);
//build a query to delete a specific record based on id
    $queryDelete = "DELETE FROM datal WHERE L_id = '$id'";
    //execute the query
    $status = mysqli_query($link, $queryDelete) or die(mysqli_error($link));
}
?>
<!DOCTYPE HTML>
<html>
    <head>
        <meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
        <title>Delete data</title>
    </head>
    <body>
        <?php
        include ('navi.php');
        //if statement to check whether the delete is successful store the success or error message into variable $msg
        if ($status) {
            $msg = "<p>data has been deleted.<br/>";
        } else {
            $msg = "<p>data deletion failed.</p>";
        }
        ?>
        <h2>FYP - Delete Item</h2>
<?php echo $msg ?>
    </body>
</html>
