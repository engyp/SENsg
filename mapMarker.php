<html>
    <head>
        <title>Map Marker</title>
        <meta name="viewport" content="initial-scale=1.0, user-scalable=no" />
        <style type="text/css">
            html { height: 100% }
            body { height: 100%; margin: 0px; padding: 0px }
            #map_canvas { height: 100% }
        </style>
        <script type="text/javascript" src="https://maps.google.com/maps/api/js?sensor=false">
        </script>
        <script type="text/javascript">
            function initialize() {
                var latlng = new google.maps.LatLng(1.283333, 103.833333);
                var myOptions = {
                    zoom: 11,
                    center: latlng,
                    mapTypeId: google.maps.MapTypeId.ROADMAP
                };
                var map = new google.maps.Map(document.getElementById("map_canvas"), myOptions);


<?php
session_start();
include ("dbFunctions.php");
$query = "SELECT * FROM datal where latitude != 'N/A'";
$result = mysqli_query($link, $query);

while ($row = mysqli_fetch_array($result)) {
    ?>
                    var hLatlng = new google.maps.LatLng(<?php echo $row['latitude']; ?>,<?php echo $row['longitude']; ?>);
                    var infoTitle = "<p>Latitude: <?php echo $row['latitude']; ?></p>" +
                            "<p>Longitude: <?php echo $row['longitude']; ?></p>" +
                            "<p>Time Stamp: <?php echo $row['time_stamp']; ?></p>" +
                            "<p>Humidity: <?php echo $row['humidity']; ?></p>" +
                            "<p>Ambient Temperature: <?php echo $row['ambient_temp']; ?></p>" +
                            "<p>Infrared Temperature: <?php echo $row['IR_temp']; ?></p>" +
                            "<p>Pressure: <?php echo $row['pressure']; ?></p>" +
                            "<p>Air Quality: <?php echo $row['air_quality']; ?></p>";

                    var hTitle = "click me";

                    var infowindow = new google.maps.InfoWindow({
                        content: infoTitle
                    });

                    var marker = new google.maps.Marker({
                        position: hLatlng,
                        map: map,
                        title: hTitle
                    });

                    function infoCallback(infowindow, marker) {
                        return function () {
                            infowindow.open(map, marker);
                        };
                    }

                    google.maps.event.addListener(marker,
                            'click', infoCallback(infowindow, marker));

    <?php
}
mysqli_close($link);
?>
            }
        </script>
    </head>
    <body onLoad="initialize();">
        <?php include ('navi.php'); ?>
        <div id="map_canvas" style="width:100%; height:100%;"></div>
    </body>
</html>