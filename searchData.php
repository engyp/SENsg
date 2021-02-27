<?php 
session_start();
?>
<html>
    <head>
        <title>Search</title>
        <link href="style/style.css" rel="stylesheet" type="text/css"/>
    </head>
    <body>
        <?php include ('navi.php'); ?>
        <h1>FYP - Search Data</h1><br>
        <form name="searchform" method="post" action="doSearchData.php" class="formLayout">
            <label for="item_name">Data ID: </label>
            <input type="number" name="data_id" /><br/>
            <input class="button" type="submit" value="Search data">
        </form>
    </body>
</html>