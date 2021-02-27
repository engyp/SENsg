<?php
include 'dbfunctions.php';
include 'navi.php';
$schQuery = ("SELECT * FROM school WHERE school_id != 2"); //school_id 2 is for admin

$schResult = mysqli_query($link, $schQuery) or die(mysqli_error($link));
?>
<!DOCTYPE HTML>
<html>
    <head>
        <meta charset="utf-8">
        <script language="javascript" type="text/javascript" src="datetimepicker.js"></script>
        <script type="text/javascript">

            var RE_NRIC = /^[Gg|Ss|Tt][\d]{7}[A-Za-z]$/; //code to validate SG IC
            function validate(form) {
                errors = [];

                var nric = form.nric.value;
                var password = form.password.value;
                var cmfpassword = form.cmfpassword.value;

                if (!RE_NRIC.test(nric)) {
                    errors[errors.length] = "Please Enter a valid NRIC"
                }

                if (password !== cmfpassword) {
                    errors[errors.length] = "\nBoth Password do not match, please re-enter your password";
                }

                if (errors.length > 0)
                {
                    alert(errors);
                    form.password.value = "";
                    form.cmfpassword.value = "";
                    return false;
                }
                return true;
            }
        </script>
        <title>Register</title>
        <!--[if lt IE 9]>
        <script src="http://html5shiv.googlecode.com/svn/trunk/html5.js"></script>
        <![endif]-->
<!--        <style>
            form{
                /*Insert CSS here to style appearance of form background, border etc*/
                padding: 10px;
                width: 400px;
            }

            fieldset{
                /*Insert CSS here to style the fieldset box*/
                border: solid 1px #ccc;
                border-radius: 20px;
                box-shadow: 2px 2px 4px rgba(0,0,0,0.3);
            }

            legend{
                /*Insert CSS here to style content within legend selector*/
                color: white;
                background: #09f;
                font-size: 14px;
                font-weight: bold;
                padding: 10px;
                border-radius: 20px;
            }

            input{
                /*Insert CSS here to style input field*/
                padding: 5px;
                border-radius: 5px;
                border: solid 1px #ccc;
                box-shadow: inset 1px 1px 2px rgba(0,0,0,0.3);
            }

            input[type="submit"]{
                font-size: 14px;
                padding: 10px;
                border: solid 2px #ccc;
                border-radius: 20px;
                font-weight: bold;
            }

            input[type="submit"]:hover{
                color: white;
                background: #09f;
            }
        </style>-->
    </head>
    <body>
        <form action="doRegister.php" method="post" onSubmit="return validate(this)">

            <fieldset>
                <legend>Personal information</legend>
                <table>
                    <tr>
                        <td>Name:</td>
                        <td><input asd required name="name" type="text"></td>
                    </tr>
                    <tr>
                        <td>NRIC:</td>
                        <td><input required name="nric" type="text" placeholder="S1234567A"></td>
                    </tr>
                    <tr>
                        <td>Email:</td>
                        <td><input required name="email" type="email" placeholder="example@hotmail.com"></td>
                    </tr>
                    <tr>
                        <td>School</td>
                        <td><select required name="school">
                                <option value="" disabled selected>Select School..</option>
                                <?php while ($row = mysqli_fetch_row($schResult)) { ?>
                                    <option value="<?php echo $row[0]; ?>"><?php echo $row[1]; ?></option>
                                <?php } ?>
                            </select></td>
                    </tr>
                    <tr>
                        <td>Password:</td>
                        <td><input required name="password" type="password"></td>
                    </tr>
                    <tr>
                        <td>Confirm Password:</td>
                        <td><input required name="cmfpassword" type="password"></td>
                    </tr>
                </table>
            </fieldset>

            <input name="submit" type="submit" value="Submit This!">
        </form>
    </body>
</html>