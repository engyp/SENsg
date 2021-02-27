<?php
include 'dbfunctions.php';
?>
<!DOCTYPE HTML>
<html>
    <head>
        <meta charset="utf-8">
        <title>Login</title>
        <!--[if lt IE 9]>
        <script src="http://html5shiv.googlecode.com/svn/trunk/html5.js"></script>
        <![endif]-->
        
    </head>
    <body>
        <?php include ('navi.php'); ?>
        <form action="doLogin.php" method="post">

            <fieldset>
                <legend>Login</legend>
                NRIC:
                <input autofocus required name="nric" type="text"><br/>
                Password:
                <input required name="password" type="password">
            </fieldset><br/>

            <input name="submit" type="submit" value="Submit This!">
        </form>
    </body>
</html>
