<?php
session_start();
$name=$_SESSION['name']
?>
<html>

    <head>
        <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
        <title>Chat</title>
        <link rel="stylesheet" href="style/style.css" type="text/css" />
        <script src="scripts/jquery-1.11.1.min.js" type="text/javascript"></script>
        <script type="text/javascript" src="scripts/chat.js"></script>
        <script type="text/javascript">

            // ask user for name with popup prompt    
            var name = <?php echo json_encode($name); ?>

            // default name is 'Guest'
            if (!name || name === ' ') {
                name = "Guest";
            }

            // strip tags
            name = name.replace(/(<([^>]+)>)/ig, "");

            // display name on page
            $("#name-area").html("You are: <span>" + name + "</span>");

            // kick off chat
            var chat = new Chat();
            $(function () {

                chat.getState();

                // watch textarea for key presses
                $("#sendie").keydown(function (event) {

                    var key = event.which;

                    //all keys including return.  
                    if (key >= 33) {

                        var maxLength = $(this).attr("maxlength");
                        var length = this.value.length;

                        // don't allow new content if length is maxed out
                        if (length >= maxLength) {
                            event.preventDefault();
                        }
                    }
                });
                // watch textarea for release of key press
                $('#sendie').keyup(function (e) {

                    if (e.keyCode == 13) {

                        var text = $(this).val();
                        var maxLength = $(this).attr("maxlength");
                        var length = text.length;

                        // send 
                        if (length <= maxLength + 1) {

                            chat.send(text, name);
                            $(this).val("");

                        } else {

                            $(this).val(text.substring(0, maxLength));

                        }


                    }
                });

            });
        </script>
    </head>

    <body onload="setInterval('chat.update()', 1000)">
        <?php include ('navi.php'); ?>
        <div id="page-wrap">
            <h2>jQuery/PHP Chat</h2>
            <p id="name-area"></p>
            <div id="chat-wrap"><div id="chat-area"></div></div>
            <form id="send-message-area">
                <p>Your message: </p>
                <textarea id="sendie" maxlength = '100' autofocus=""></textarea>
            </form>
        </div>
    </body>
</html>